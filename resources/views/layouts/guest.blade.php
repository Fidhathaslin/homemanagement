<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'dashcode') }}</title>
        <x-favicon/>
        {{-- Scripts --}}
        @vite(['resources/sass/app.scss'])
    </head>
    <body>

        <div class="loginwrapper">
            <div class="lg-inner-column">
                <div class="left-column relative z-[1]">
                    <div class="max-w-[520px] pt-20 ltr:pl-20 rtl:pr-20">
                       <!-- APPLICATION LOGO  -->
                         <div class="mb-6">
                            <x-application-logo />
                        </div> 
                    </div>
                    <div class="absolute left-0 2xl:bottom-[-160px] bottom-[-130px] h-full w-full z-[-1]">
                        <img class="h-full w-full object-containll" src="{{ asset('images/logo/loginimage.png') }}" alt="image">
                    </div>
                </div>
                <div class="right-column  relative">
                    <div class="inner-content h-full flex flex-col bg-white dark:bg-slate-800">
                        {{ $slot }}
                        <div class="auth-footer text-center">
                            {{ __('Copyright') }}
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            , <a href="#">{{ __('Home Management') }}</a>
                            {{ __('All Rights Reserved.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @vite(['resources/js/app.js'])
    </body>
</html>
