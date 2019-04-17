<!DOCTYPE html>
<html class="loading" xmlns="https://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br" data-textdirection="ltr">
    @include('comuns.head')
    <body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns  " data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">
        @include('comuns.aside')
        @yield('content')
        @include('comuns.footer')
        @include('comuns.bottom')
    </body>
</html>