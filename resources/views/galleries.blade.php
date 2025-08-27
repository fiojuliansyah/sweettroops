@extends('layouts.guest')

@section('content')
    <section class="section-26">
        <div class="w-layout-blockcontainer container-25 w-container">
            <h1 class="heading-16">Hands-On Classes</h1>
        </div>
    </section>
    <section class="section-27">
        <div class="w-layout-blockcontainer container-26 w-container">
            <div class="text-block-7">
                Our hands-on classes are where the magic truly happens - mixing, whisking, and creating
                side by side in the SweetTroops kitchen.<br>
                Each session is a chance to learn new techniques, share stories,
                and turn fellow bakers into new friends and family.<br>
                While our hands-on classes are currently taking a little break,
                we&#x27;ll be back soon with fresh classes and even more memories to make together.<br>
                In the meantime, feel free to explore the gallery below to see some of our favourite moments from past events!
            </div>
        </div>
    </section>

    <section class="section-28">
        <div class="w-layout-blockcontainer container-27 w-container">
            <div class="collection-list-wrapper-3 w-dyn-list">
                <div role="list" class="collection-list-3 w-dyn-items w-row">
                    
                    @foreach($galleries as $gallery)
                        <div role="listitem" class="collection-item-3 w-dyn-item w-col w-col-6">
                            <a href="{{ asset('storage/'.$gallery->image) }}"
                               class="w-inline-block w-lightbox"
                               aria-label="open lightbox" aria-haspopup="dialog">
                                <img src="{{ asset('storage/'.$gallery->image) }}"
                                     loading="lazy" alt="{{ $gallery->title }}"
                                     class="image-14">

                                {{-- lightbox data --}}
                                <script type="application/json" class="w-json">
                                {
                                    "items": [
                                        {
                                            "url": "{{ asset('storage/'.$gallery->image) }}",
                                            "type": "image"
                                        }
                                    ],
                                    "group": ""
                                }
                                </script>
                            </a>
                            <a href="#" class="link-5">{{ $gallery->title }}</a>
                            <div class="text-block-8">{{ $gallery->created_at->format('d M Y') }}</div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
