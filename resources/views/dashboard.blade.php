<x-app-layout>
    <div class="space-y-8">
        <div class="space-y-5 ">
            <div class="card p-6 ">
                <div class="grid xl:grid-cols-4 lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-5 place-content-center ">
                    {{-- User Profile Section --}}
                    <div class="flex space-x-4 h-full items-center rtl:space-x-reverse col-span-1 ">
                        <div class="flex-none">
                            <div class="h-20 w-20 rounded-full">
                                <img src="{{ auth()->user()->getFirstMediaUrl('user-profile-picture') }}"
                                    alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-medium mb-2">
                               
                                <span class="block font-light">{{ $greeting }},</span>
                                <span class="block">{{ auth()->user()->name }}</span>
                            </h4>
                         </div> 
                        
                    </div>

                   
                   
          

    
      </div>
    </div>
</x-app-layout>
