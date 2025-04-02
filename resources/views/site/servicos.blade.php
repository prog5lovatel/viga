@extends('site.layouts.base')

@section('title', 'Serviços - ' . config('app.name'))

@section('conteudo')

    <section class="sectionTopoInternas">
        <img src="{{ @Vite::asset('resources/assets/site/img/topoServicos.png') }}" alt="Serviços">
        <div class="sobreInternas main flex_c">
            <h1 class="main-t whiteFont bold margin10">Serviços</h1>
            <span class="flex lineYellow"></span>
        </div>
    </section>
    <main class="mainServicos">
        <section class="sobreSection container">
            <div class="main flex_c">
                <p>A Viga Pavimentação Asfáltica oferece uma gama de serviços completos para atender diferentes necessidades de infraestrutura. Confira abaixo os principais serviços que disponibilizamos:<p>

                <div class="grid3 gridServicos">
                    @for ($s = 0; $s < 5; $s++)
                    <a href="{{ route('servicos.detalhes') }}" class="flex_c itemServicos">
                        <img src="https://dummyimage.com/830x680/" alt="nome serviço">
                        <div class="flex_c middle sobreServicos">
                            <h2 class="med-t whiteFont t-center center bold">
                                Pavimentação Asfáltica
                            </h2>
                        </div>
                    </a>
                    @endfor
                </div>
            </div>
        </section>
    </main>

@endsection
