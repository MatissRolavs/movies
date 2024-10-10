<style>
        #fullscreen-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

  
                   
                    <iframe src="https://play2.123embed.net/movie/tt0372784" id="videoIframe" width="600" height="400" style="border:none;" title="Video Player">Nothing</iframe>
                        
                        <button id="fullscreen-btn">Go Fullscreen</button>
    
</x-app-layout>
<script>
        document.getElementById('fullscreen-btn').addEventListener('click', function() {
            var iframe = document.getElementById('videoIframe');
            if (iframe.requestFullscreen) {
                iframe.requestFullscreen();
            } else if (iframe.mozRequestFullScreen) { // Firefox
                iframe.mozRequestFullScreen();
            } else if (iframe.webkitRequestFullscreen) { // Chrome, Safari and Opera
                iframe.webkitRequestFullscreen();
            } else if (iframe.msRequestFullscreen) { // IE/Edge
                iframe.msRequestFullscreen();
            }
        });
    </script>