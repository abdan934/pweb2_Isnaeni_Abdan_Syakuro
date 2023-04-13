@if ($errors->any())
<label>
    <input type="checkbox" class="alertCheckbox" autocomplete="off" />
     <div class="alert {!!$alert!!}">
        <span class="alertClose"></span>
        <span class="alertText">
            @foreach ($errors->all() as $error)
            {{ $error }}<br>
            @endforeach
         </span>
    </div>
</label>
 <script>
     setTimeout(function() {
    document.getElementById("signUp").click();
    }, 100);
 </script>
@endif

@if (isset($pesan))
			<label>
				<input  id="labelpesan" type="checkbox" class="alertCheckbox" autocomplete="off"  />
				<div class="alert {{$alert}}" >
				  <span class="alertClose"></span>
				  <span class="alertText">
					{{$pesan}}
				  <br class="clear"/></span>
				</div>
			</label>

 @endif