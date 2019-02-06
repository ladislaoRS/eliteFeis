@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3 border-0 bg-transparent">
                <div class="card-body py-0 px-1">
                    <avatar-form :user="{{ $profileUser }}"></avatar-form>
                    <span class="h6 text-muted text-uppercase">Writer | {{ $profileUser->created_at->toFormattedDateString() }}</span>
                    <br>
                    <a class="small" href="/profiles/{{ $profileUser->name }}">Profile</a>
                    <div class="pb-4 mb-4"> </div>
                    
                    @forelse($activities as $date => $register)
                        <h5 class="mb-3 font-weight-bold text-muted">{{ $date }}</h5>
                        @foreach($register as $activity)
                            @if(view()->exists("profiles.activities.{$activity->type}"))
                                @include("profiles.activities.{$activity->type}")
                            @endif
                        @endforeach
                       
                        <br class="mb-5">
                    @empty
                        <h5 class="text-center mt-4 pt-4">{{ $profileUser->name }} hasn't registered any activity yet.</h5>
                        <!--<hr>-->
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection