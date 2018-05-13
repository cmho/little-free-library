@extends('layouts.app')

@section('content')
  @while (have_posts()) @php the_post() @endphp
    <section id="featured" class="section">
        <div class="wrapper">
            <div class="row">
              <div class="col-xs-12">
                <h2>Recent Uploads</h2>
              </div>
                @foreach(FrontPage::recentUploads() as $upload)
                    <div class="col-md-3 col-sm-6 col-xs-12 media-item">
                        <div class="thumb">
                            <a href="{{ wp_get_attachment_url($upload->ID) }}" target="_blank">
                                {!! wp_get_attachment_image($upload->ID, 'large') !!}
                            </a>
                        </div>
                        <h3><a href="{{ wp_get_attachment_url($upload->ID) }}" target="_blank">{{ $upload->post_title }}</a></h3>
                        @if(get_field('author', $upload))
                            <p class="byline">by {{ get_field('author', $upload) }}</p>
                        @endif
                        @php
                            $terms = get_the_terms($upload, 'attachment_tag');
                            $term_content = array();
                            $term_links = array();
                            if ($terms) {
                                $term_links = array_map(function($x) {
                                    return '<a href="'.get_term_link($x, 'attachment_tag').'">#'.$x->name.'</a>';
                                }, $terms);
                                if ($term_links) {
                                    $term_content = join(", ", $term_links);
                                }
                            }
                        @endphp
                        @if($term_content)
                            <p class="tags">{!! $term_content !!}</p>
                        @endif
                        <div class="button-row">
                          <a href="{{ wp_get_attachment_url($upload->ID) }}" target="_blank" class="button">Download</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="about" class="section">
        <div class="wrapper">
            <div class="row">
                <div class="col-xs-12">
                  <h2>About</h2>
                    @include('partials.content-'.get_post_type())
                </div>
            </div>
        </div>
    </section>
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection
