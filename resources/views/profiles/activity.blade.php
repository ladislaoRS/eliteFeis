@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 border-0">
                <div class="card-body py-0 px-1">
                    <span class="h1">{{ $profileUser->name }}</span>
                    <br>
                    <span class="h6 text-muted text-uppercase">Writer | {{ $profileUser->created_at->toFormattedDateString() }}</span>
                    <br>
                    <a class="small" href="/profiles/{{ $profileUser->name }}">Profile</a>
                    <hr class="pb-4 mb-4">
                    
                    @forelse($activities as $date => $register)
                        <h5 class="mb-3 font-weight-bold text-muted">{{ $date }}</h5>
                        @foreach($register as $activity)
                            @include("profiles.activities.{$activity->type}")
                        @endforeach
                       
                        <br class="mb-5">
                    @empty
                        <h5 class="text-center mt-4 pt-4">{{ $profileUser->name }} hasn't registered any activity yet.</h5>
                        <hr>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection