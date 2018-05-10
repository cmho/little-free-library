@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  @while (have_posts()) @php the_post() @endphp
    <section id="featured" class="section">
        <div class="wrapper">
            <div class="row">
                @foreach(FrontPage::recentUploads() as $upload)
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="thumb">
                            <a href="{{ $upload->guid }}">
                                <img src="{{ wp_get_attachment_thumb_url($upload->ID) }}" />
                            </a>
                        </div>
                        <h3><a href="{{ $upload->guid }}" target="_blank">{{ $upload->post_title }}</a></h3>
                        @if(get_field('author', $upload))
                            <p class="byline">by {{ get_field('author', $upload) }}</p>
                            @php
                                $terms = get_the_terms($upload, 'media_tag');
                                $term_content;
                                $term_links;
                                if ($terms) {
                                    $term_links = array_map(function($x) {
                                        return '<a href="'.get_term_link($x, 'media_tag').'">#'.$x->name.'</a>';
                                    }, $terms);
                                    if ($term_links) {
                                        $term_content = join(", ", $term_links);
                                    }
                                }
                            @endphp
                            @if($term_content)
                                <p class="tags">{!! $term_content !!}</p>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="about" class="section">
        <div class="wrapper">
            <div class="row">
                <div class="col-xs-12">
                    @include('partials.content-'.get_post_type())
                </div>
            </div>
        </div>
    </section>
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection
