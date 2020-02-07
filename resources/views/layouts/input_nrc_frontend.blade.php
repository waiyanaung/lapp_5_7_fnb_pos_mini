
<div class="col-sm-2">
	<label >NRIC *</label>
	@if(isset($nrc))
	<select class="form-control background_lightblue" name="nrc_division">
		@for($i=1;$i<=14;$i++) @if($nrc->nrc_division == $i)
			<option value="{{$nrc->nrc_division}}" selected>
				{{$i}}/
			</option>
			@else
			<option value="{{ $i }}">{{ $i }}/</option>
			@endif
			@endfor
	</select>
	@else
	<select class="form-control background_lightblue" name="nrc_division">
		@for($i=1;$i<=14;$i++){ <option value="{{$i}}">
			{{$i}}/
			</option>
			@endfor
	</select>
	@endif
</div>

<div class="col-sm-1">
	<br>
	@if(isset($nrc))
	<select class="form-control background_lightblue" name="nrc_township1">
		@foreach(range('A','Z') as $j)
		@if($nrc->nrc_township1 == $j)
		<option value="{{$nrc->nrc_township1}}" selected>
			{{$j}}
		</option>
		@else
		<option value="{{$j}}">
			{{$j}}
		</option>
		@endif
		@endforeach
	</select>
	@else
	<select class="form-control background_lightblue" name="nrc_township1">
		@foreach(range('A','Z') as $j)
		<option value="{{$j}}">
			{{$j}}
		</option>
		@endforeach
	</select>
	@endif
</div>

<div class="col-sm-1">
	<br>
	@if(isset($nrc))
	<select class="form-control background_lightblue" name="nrc_township2">
		@foreach(range('A','Z') as $j)
		@if($nrc->nrc_township2 == $j)
		<option value="{{$nrc->nrc_township2}}" selected>
			{{$j}}
		</option>
		@else
		<option value="{{$j}}">
			{{$j}}
		</option>
		@endif
		@endforeach
	</select>
	@else
	<select class="form-control background_lightblue" name="nrc_township2">
		@foreach(range('A','Z') as $j)
		<option value="{{$j}}">
			{{$j}}
		</option>
		@endforeach
	</select>
	@endif
</div>

<div class="col-sm-1">
	<br>
	@if(isset($nrc))
	<select class="form-control background_lightblue" name="nrc_township3">
		@foreach(range('A','Z') as $j)
		@if($nrc->nrc_township3 == $j)
		<option value="{{$nrc->nrc_township3}}" selected>
			{{$j}}
		</option>
		@else
		<option value="{{$j}}">
			{{$j}}
		</option>
		@endif
		@endforeach
	</select>
	@else
	<select class="background_lightblue form-control" name="nrc_township3">
		@foreach(range('A','Z') as $j)
		<option value="{{$j}}">
			{{$j}}
		</option>
		@endforeach
	</select>
	@endif
</div>

<div class="col-sm-3">
	<br>
	@if(isset($nrc))
	<select class="form-control background_lightblue" name="nrc_national">
		@if($nrc->nrc_national == 'N')
		<option value="N" selected>(N)
			@else
		<option value="N">(N)
			@endif

			@if($nrc->nrc_national == 'E')
		<option value="E" selected>(E)
			@else
		<option value="E">(E)
			@endif

			@if($nrc->nrc_national == 'P')
		<option value="P" selected>(P)
			@else
		<option value="P">(P)
			@endif
	</select>
	@else
	<select class="form-control background_lightblue" name="nrc_national">
		<option value="N">(N)
		<option value="E">(E)
		<option value="P">(P)
	</select>
	@endif
</div>

<div class="col-sm-4">
	<br>
	<input autocomplete="off" type="text" class="floatLabel form-control" placeholder="User NRIC Number" name="nrc_number" value="{{ isset($nrc)? $nrc->nrc_number:Request::old('nrc_number') }}">
	<label class="text-danger">{{$errors->first('nrc_number')}}</label>
</div>