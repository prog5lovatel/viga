<ul class="dl-menu">
    <li {!! Request::routeIs('home') ? 'class="ativo"' : null !!}><a href="{{ route('home') }}">Início</a></li>
    <li {!! Request::routeIs('sobre') ? 'class="ativo"' : null !!}><a href="{{ route('sobre') }}">Quem Somos</a></li>
    <li {!! Request::routeIs('home.marcas') || Request::routeIs('marcas.*')  ? 'class="ativo"' : null !!}><a href="{{ Request::routeIs('home*') ? 'javascript:;' : route('home.marcas') }}" rel="marcas" class="marcas">Clientes</a></li>
    <li {!! Request::routeIs('servicos*') ? 'class="ativo"' : null !!}><a href="{{ route('servicos') }}">Serviços</a></li>
    <li {!! Request::routeIs('obras*') ? 'class="ativo"' : null !!}><a href="{{ route('obras') }}">Obras</a></li>
    <li {!! Request::routeIs('ouvidoria') ? 'class="ativo"' : null !!}><a href="{{ route('ouvidoria') }}">Ouvidoria</a></li>
    <li {!! Request::routeIs('documentos') ? 'class="ativo"' : null !!}><a href="{{ route('documentos') }}">Documentos</a></li>


    <li {!! Request::routeIs('contato*') ? 'class="ativo"' : null !!}><a class="flex middle gap10" href="javascript:;">Contato
        <figure class="whFitImg">
            <img src="{{@Vite::asset('resources/assets/site/img/arrowDown.png')}}" alt="Arrow Down">
        </figure>
    </a>
        <ul class="dl-subMenu">
            <li><a href="{{ route('contato') }}">Fale Conosco</a></li>
            <li><a href="{{ route('contato.trabalhe') }}">Trabalhe Conosco</a></li>
        </ul>
    </li>
</ul>
