<x-layout :pageHeading="'Application Details'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Application Details</h1>
        
        <!-- All application detials -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">User Information</h2>
            <p><strong>Name:</strong> {{ $application->user->first_name }} {{ $application->user->last_name }}</p>
            <p><strong>Email:</strong> {{ $application->user->email }}</p>
            <p><strong>Phone Number:</strong> {{ $application->phone_number }}</p>
            
            <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-6">Application Information</h2>
            <p><strong>Subjects:</strong> 
                @foreach(json_decode($application->subjects) as $subject)
                    {{$subject . ','}}
                @endforeach
            </p>
            <p><strong>Availability:</strong> {{ $application->availability }}</p>
            <p><strong>Description:</strong> {{ $application->description }}</p>
            <p><strong>Experience:</strong> {{ $application->experience }}</p>
        </div>
    </div>
</x-layout>