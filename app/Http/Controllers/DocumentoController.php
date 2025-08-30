<?php

namespace App\Http\Controllers;
use App\Models\Documento;
use Illuminate\Http\Request;
use Smalot\PdfParser\Parser as PdfParser;
use PhpOffice\PhpWord\IOFactory;
use thiagoalessio\TesseractOCR\TesseractOCR;

class DocumentoController extends Controller
{
    // Mostrar todos los documentos
    public function index()
    {
        return view('documentos.main');
    }

    public function crear(Request $request)
    {

        $file = $request->file('documento');
        if ($file) {
            // $apiKey = config('deepseek.api_key');
            try {
                $extension = strtolower($file->getClientOriginalExtension());
                $contenido = '';

                // ---------- PDF ----------
                if ($extension === 'pdf') {
                    $parser = new PdfParser();
                    $pdf = $parser->parseFile($file->getRealPath());
                    $contenido = trim($pdf->getText());

                    // Si no hay texto, usar OCR
                    if (empty($contenido) || strlen($contenido) < 10) {
                        $tempDir = sys_get_temp_dir();
                        $pdfFile = $file->getRealPath();
                        $outputPrefix = tempnam($tempDir, 'pdfpage_');

                        // Convertir PDF a imágenes usando Poppler
                        $cmd = "pdftoppm -jpeg \"$pdfFile\" \"$outputPrefix\"";
                        exec($cmd, $output, $return_var);
                        if ($return_var !== 0) {
                            throw new \Exception("Error al convertir PDF a imágenes con pdftoppm.");
                        }

                        // Buscar imágenes generadas y extraer texto con Tesseract
                        $images = glob($outputPrefix . "-*.jpg");
                        foreach ($images as $img) {
                            $contenido .= (new TesseractOCR($img))
                                ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe')
                                ->run() . "\n";
                            unlink($img); // Limpiar imagen temporal
                        }

                        @unlink($outputPrefix);
                    }

                    // ---------- Word ----------
                } elseif (in_array($extension, ['doc', 'docx'])) {
                    $phpWord = IOFactory::load($file->getRealPath());
                    foreach ($phpWord->getSections() as $section) {
                        foreach ($section->getElements() as $element) {
                            if (method_exists($element, 'getText')) {
                                $contenido .= $element->getText() . "\n";
                            }
                        }
                    }

                    // ---------- Imagen ----------
                } elseif (in_array($extension, ['jpg', 'jpeg', 'png', 'bmp'])) {
                    $contenido = (new TesseractOCR($file->getRealPath()))
                        ->executable('C:\Program Files\Tesseract-OCR\tesseract.exe')
                        ->run();

                } else {
                    throw new \Exception("Formato no soportado: $extension");
                }

                return view('documentos.crear', ['respuesta' => $contenido]);


            } catch (\Exception $e) {
                return view('documentos.crear', [
                    'respuesta' => $e->getMessage(),
                ]);
            }
        }
        return view('documentos.crear');
    }

    // Crear un nuevo documento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'tamano' => 'required|string|max:200',
            'tipo' => 'required|string|max:200',
            'documento' => 'required|string',
            'data' => 'nullable|array',
        ]);

        $documento = Documento::create($validated);

        return response()->json($documento, 201);
    }

    // Mostrar un documento por id
    public function show($id)
    {
        $documento = Documento::findOrFail($id);
        return response()->json($documento, 200);
    }

    // Actualizar un documento
    public function update(Request $request, $id)
    {
        $documento = Documento::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'sometimes|string',
            'tamano' => 'sometimes|string|max:200',
            'tipo' => 'sometimes|string|max:200',
            'documento' => 'sometimes|string',
            'data' => 'nullable|array',
        ]);

        $documento->update($validated);

        return response()->json($documento, 200);
    }

    // Eliminar un documento
    public function destroy($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();

        return response()->json(['message' => 'Documento eliminado correctamente'], 200);
    }


    public function ListaDocumentos()
    {
        return response()->json(Documento::select('id', 'nombre', 'tamano', 'tipo', 'documento', 'data')->get());
    }
}
