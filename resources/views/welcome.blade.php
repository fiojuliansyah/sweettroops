@extends('layouts.guest')

@section('content')
<div class="spark-section spark-hero-background-image-with-centered-content">
        <div class="spark-container spark-centered-content w-container">
            <h1>SWEET TROOPS</h1>
            <p class="spark-hero-sub-paragraph">Start your sweet journey here...</p>
        </div>
    </div>
    <section class="section-46">
        <div class="container-4">
            <h2 class="centered-heading-2">UPCOMING&nbsp; CLASS</h2>
            <div class="team-grid-2">
                <div id="w-node-_36ac2f68-a88d-cff4-a9cd-531130bbd2f6-05a7959e" class="pc-card"><img
                        src="https://cdn.prod.website-files.com/685911588c01846905a79595/685a43905afd9b945b3163d4_Blackforest%20PC.png"
                        loading="lazy" sizes="(max-width: 1536px) 100vw, 1536px"
                        srcset="https://cdn.prod.website-files.com/685911588c01846905a79595/685a43905afd9b945b3163d4_Blackforest%20PC-p-500.png 500w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a43905afd9b945b3163d4_Blackforest%20PC-p-800.png 800w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a43905afd9b945b3163d4_Blackforest%20PC-p-1080.png 1080w, https://cdn.prod.website-files.com/685911588c01846905a79595/685a43905afd9b945b3163d4_Blackforest%20PC.png 1536w"
                        alt="" class="pc-image"><a href="#" class="pc-link">Blackforest</a>
                    <div class="pc-date">Sat, 19 July 2025</div>
                </div>
                <div id="w-node-_36ac2f68-a88d-cff4-a9cd-531130bbd301-05a7959e" class="pc-card"><img
                        src="https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d0a2c47cd3f4aab3d9_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_37_22%20AM.png"
                        loading="lazy" sizes="(max-width: 1024px) 100vw, 1024px"
                        srcset="https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d0a2c47cd3f4aab3d9_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_37_22%20AM-p-500.png 500w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d0a2c47cd3f4aab3d9_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_37_22%20AM-p-800.png 800w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d0a2c47cd3f4aab3d9_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_37_22%20AM.png 1024w"
                        alt="" class="pc-image">
                    <div class="team-member-name pc-title-cs">Set your timer...</div>
                </div>
                <div id="w-node-_36ac2f68-a88d-cff4-a9cd-531130bbd30b-05a7959e" class="pc-card"><img
                        src="https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d178fc9268a2bf8abf_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_43_09%20AM.png"
                        loading="lazy" sizes="(max-width: 1024px) 100vw, 1024px"
                        srcset="https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d178fc9268a2bf8abf_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_43_09%20AM-p-500.png 500w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d178fc9268a2bf8abf_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_43_09%20AM-p-800.png 800w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c36d178fc9268a2bf8abf_ChatGPT%20Image%20Jun%2026%2C%202025%2C%2012_43_09%20AM.png 1024w"
                        alt="" class="pc-image">
                    <div class="team-member-name pc-title-cs">Set your timer...</div>
                </div>
                <div id="w-node-_36ac2f68-a88d-cff4-a9cd-531130bbd315-05a7959e" class="pc-card"><img
                        src="https://cdn.prod.website-files.com/685911588c01846905a79595/685c39b775c27e07a91a3474_Kneading%20a%20Little%20More%20Time%20G.png"
                        loading="lazy" sizes="(max-width: 1536px) 100vw, 1536px"
                        srcset="https://cdn.prod.website-files.com/685911588c01846905a79595/685c39b775c27e07a91a3474_Kneading%20a%20Little%20More%20Time%20G-p-500.png 500w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c39b775c27e07a91a3474_Kneading%20a%20Little%20More%20Time%20G-p-800.png 800w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c39b775c27e07a91a3474_Kneading%20a%20Little%20More%20Time%20G-p-1080.png 1080w, https://cdn.prod.website-files.com/685911588c01846905a79595/685c39b775c27e07a91a3474_Kneading%20a%20Little%20More%20Time%20G.png 1536w"
                        alt="" class="pc-image">
                    <div class="team-member-name pc-title-cs">Set your timer...</div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-4">
            <h2 class="centered-heading-2">NEWEST &nbsp;CLASS</h2>
            <div class="team-grid-2">
               @forelse ($courses as $course)
                  <div id="w-node-ca84af2a-9836-8afa-9f74-52860d2bdefe-05a7959e" class="pc-card">
                    @php
                        $thumbnails = json_decode($course->thumbnail, true);
                        $firstThumbnail = isset($thumbnails[0])
                            ? $thumbnails[0]
                            : 'default-thumbnail.jpg';
                    @endphp
                  <img src="{{ asset('storage/' . $firstThumbnail) }}" loading="lazy" class="pc-image"><a href="#" class="pc-link">{{ $course->title }}</a>
                  </div> 
               @empty
                   
               @endforelse
            </div>
        </div>
    </section>
@endsection
