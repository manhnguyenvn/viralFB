{{--*/ $image = str_replace('\\', '/', $aplicatie->img) /* --}}
<div class="col-sm-6 col-md-3 appbox" onclick="window.location='{{ url("/$aplicatie->appname") }}'">
   <div class="new-app-container">
       <div class="newa-background"><img src="{{ url("$image") }}"></div>
       <div class="newa">
           <div class="new-app-description">
               <span class="appstitle"><i class="fa fa-arrow-right" aria-hidden="true"></i> {{ $aplicatie->title }}</span>
           </div>
       </div>
   </div>
</div>

