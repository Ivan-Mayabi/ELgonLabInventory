<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Dashboard') - {{env('APP_NAME')}}</title>
    <!-- favicon -->
    {{-- <link rel="shortcut icon" href="{{ asset('favicon.png') }}" /> --}}
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Waterfall&display=swap" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.css') }}" />
    <!--end::Required Plugin(AdminLTE)-->
    <style>
      .waterfall-regular {
  font-family: "Waterfall", cursive;
  font-weight: 400;
  font-style: normal;
}
      </style>
    {{-- Page-specific styles --}}
    @stack('styles')
  </head>
  <!--end::Head-->
  
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      
      {{-- Include Header --}}
      @include('layouts.partials.header')
      
      {{-- Include Sidebar --}}
      @include('layouts.partials.sidebar')
      
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">@yield('page-title', 'Dashboard')</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  @yield('breadcrumb')
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            
            {{-- Flash Messages --}}
            @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            
            @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

          {{-- Find out where this is supposed to be --}}
          <style>
            .appliance{
              cursor:pointer;
              transition: all 0.3s ease;
            }

            .appliance:hover path{
              transform:scale(1.05);
              transform-origin:center;
              fill: black !important;
              stroke: black !important;
              transition: all 0.3s ease;
            }

            #room-container{
              max-width:100%;
              max-height:100vh;
            }
            
            #room-container.zoomed .appliance{
              display:none !important;
            }

            #room-container.zoomed .appliance.active{
              cursor:not-allowed;
              display:block !important;
              transform-origin:center;
              transform:scale(1.1);
            }

            /* Make the item black when clicked */
            #room-container.zoomed .appliance.active path{
              fill:black !important;
              stroke:white !important;
            }

            /* Make the zoomed items to become side by side */
            #zoom-container.zoomed{
              display:flex;
            }

            #zoom-container.zoomed #room-container{
              flex:1;
              max-height:100vh;
              border:1px solid red;
              display:flex;
              align-items:center;
              justify-content:center;
              overflow:hidden;
            }

            /* Make the things that are there to have a flex of 50, 50 */
            #zoom-container.zoomed #display-component{
              flex:1;
              border:10px solid blue;
            }

            /* Make the rows be visible */
            td,th{
              border:1px solid black;
            }
          </style>

          {{-- The layout --}}
          {{-- Back Button --}}
          <div x-data>
            <button id="back-btn" class="btn btn-dark d-none mb-3" onclick="resetView()" @click="Livewire.dispatch('computerReset')">
              <i class="bi bi-arrow-left d-inline m-2"></i>Back to room
            </button>
        </div>

          {{-- Create new item/Update from csv --}}
          {{-- Button --}}
          <button id="create-btn" class="btn btn-dark mb-3" onclick="showForm()">
              Create New Computer
          </button>

          {{-- Button to start the sending from form --}}
          <form action="{{route("pcinventories.massCreate")}}" class="d-inline" method="POST">
            @csrf
            <button id="update-from-list-btn" class="btn btn-dark mb-3">
                Load from Form
            </button>
          </form>

          {{-- Update New Item --}}
          <button id="update-btn" class="btn btn-dark d-none mb-3">
              Update New Computer
          </button>

          {{-- Livewire Component for creation--}}
          <div id="create-computer-form" class="d-none">
            <livewire:computers/>
          </div>

          <script>
            function goBack(){
                const createForm = document.getElementById('create-computer-form');
                
                createForm.classList.add('d-none');
            }
          </script>   

          <script>
            function showForm(){
              const createForm = document.getElementById('create-computer-form');

              createForm.classList.remove('d-none');
            }
          </script>

          <div id="zoom-container">
            <div id="room-container">
              {{-- Place the Component here --}}
              <x-room-component/>
            </div>

            <livewire:computer-details/>
          </div>

          {{-- The functionality --}}
          <script>
            // This script only works when the DOM is fully loaded
            document.addEventListener('DOMContentLoaded',function(){
                const appliances = document.querySelectorAll('.appliance');
                const backButton = document.getElementById('back-btn');
                const createButton = document.getElementById('create-btn');
                const updateButton = document.getElementById('update-btn');
                const flexContainer = document.getElementById('zoom-container');
                const roomContainer = document.getElementById('room-container');

                // Zoom functionality on each individual item on the SVG
                appliances.forEach(item => {
                  item.addEventListener('click',function(){
                    // Add a zoomed class -> will allow toggling between none and block
                    roomContainer.classList.add('zoomed');

                    // Make side by side, display the other Area
                    flexContainer.classList.add('zoomed');

                    // Make sure nothing else is active
                    appliances.forEach(otherItem => {otherItem.classList.remove('active')});
                    
                    // Make one active
                    item.classList.add('active');

                    // Disable scrolling
                    // document.body.style.overflow = 'hidden';

                    // Make back button visible
                    backButton.classList.remove('d-none');
                    createButton.classList.remove('d-none');
                    createButton.classList.add('d-inline');
                    updateButton.classList.remove('d-none');
                    updateButton.classList.add('d-inline');
                    
                    // Debug
                    console.log('Clicked:',item.id);
                  })
                })


            })

            // Button functionality
            function resetView(){
              const appliances = document.querySelectorAll('.appliance');
              const backButton = document.getElementById('back-btn');
              const createButton = document.getElementById('create-btn');
              const updateButton = document.getElementById('update-btn');
              const flexContainer = document.getElementById('zoom-container');
              const roomContainer = document.getElementById('room-container'); 

              // Disable Back Button
              backButton.classList.add('d-none');
              // createButton.classList.remove('d-none');
              updateButton.classList.add('d-none');

              // Remove the zoomed class and active classse
              appliances.forEach(Item=> Item.classList.remove('active'));
              roomContainer.classList.remove('zoomed');

              // Allow scrolling if necessary
              document.body.style.overflow = 'auto';

              // Return to normal svg functionality
              flexContainer.classList.remove('zoomed');
              
            }

          </script>

            
            {{-- Main Content Area - This is where child views inject content --}}
            @yield('content')

  
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      
      {{-- Include Footer --}}
      @include('layouts.partials.footer')
      
    </div>
    <!--end::App Wrapper-->
    
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    
    <!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)-->
    
    <!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)-->
    
    <!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('adminlte/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)-->
    
    <!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    
    {{-- Page-specific scripts --}}
    @stack('scripts')
    
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
