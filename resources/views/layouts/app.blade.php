<!doctype html>
<html @php language_attributes() @endphp>
  @include('partials.head')
  <body @php body_class() @endphp>
    <div id="page">
      @php do_action('get_header') @endphp
      @include('partials.header')
      <main class="main">
        @yield('content')
      </main>
      @if (App\display_sidebar())
        <aside class="sidebar">
          @include('partials.sidebar')
        </aside>
      @endif
      @php do_action('get_footer') @endphp
      @include('partials.footer')
    </div>
    @php wp_footer() @endphp
  </body>
</html>
