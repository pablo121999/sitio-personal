<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/css/swiper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.4.2/js/swiper.min.js"></script>


<div class="tcontainer" style="border-radius: 20px;">
    <div class="timeline">
        <div class="swiper-container">
            <div class="swiper-wrapper">

                @foreach ($LineaTiempo as $linea)
                    <div class="swiper-slide" style="background-image: url({{ asset('storage/' . $linea->imagen) }}"
                        data-year="{{ $linea->ano }}">
                        <div class="swiper-slide-content"><span class="timeline-year"> {{ $linea->ano }}</span>
                            <p class="timeline-title">{{ $linea->titulo }}</p>
                            <p class="timeline-text">{{ $linea->descripcion }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!--  <div class="swiper-pagination"></div> -->
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ asset('css/timeline.css') }}">
<script src="{{ asset('js/timeline.js') }}"></script>
