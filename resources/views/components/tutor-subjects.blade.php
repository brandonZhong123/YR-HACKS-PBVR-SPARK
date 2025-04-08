@props(['tutorSubjects'])

@php
// Parse tutors subjects as an array
$subjects = json_decode($tutorSubjects);
@endphp

<ul class="flex mt-4">
  <!-- Loop through array to find subjects -->
  @foreach($subjects as $subject)
  <li class="flex items-center justify-center bg-gray-700 text-white rounded-xl py-1 px-3 mr-2 text-xs ">
    <a href="tutors/?subject={{$subject}}">{{$subject}}</a>
  </li>
  @endforeach
</ul>