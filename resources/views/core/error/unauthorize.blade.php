<?php
/**
 * Created by Visual Studio Code.
 * Author: Wai Yan Aung
 * Date: 7/4/2016
 * Time: 11:39 AM
 */
?>

@extends('layouts.master')
@section('title','UnAuthorize')
@section('content')

<!-- begin #content -->
<h1 class="page-header">Error !</h1>

<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">{{$errorMessage}}</h1>
	</div>
</div>
@stop

@section('page_script')
@stop