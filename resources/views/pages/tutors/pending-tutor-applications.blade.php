<x-layout :pageHeading="'Tutor Applications'">
    <div class="p-6">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Pending Tutor Applications</h1>
        
        @if($applications->isEmpty())
            <p>No pending applications.</p>
        @else
            <!-- Pending application table -->
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <!-- Table headers -->
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Details</th>
                        @if (Auth::user()->role == 'admin')<th class="py-2 px-4 border-b">Actions</th> @endif
                    
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop for each table row -->
                    @foreach ($applications as $application)
                        <!-- Status -->
                        <tr class="hover:bg-gray-100">
                            <td class="py-4 px-6 border-b text-center">
                                @if($application->status == 'Pending')
                                    <p class="text-yellow-500">{{ $application->status }}</p>
                                @elseif($application->status == 'Approved')
                                    <p class="text-green-500">{{ $application->status }}</p>
                                @elseif($application->status == 'Denied')
                                    <p class="text-red-500">{{ $application->status }}</p>
                                @endif
                            </td>
                            <!-- Table information -->
                            <td class="py-4 px-6 border-b text-center">{{ $application->user->first_name . ' ' . $application->user->last_name }}</td>
                            <td class="py-4 px-6 border-b text-center">{{ $application->user->email }}</td>
                            <td class="py-4 px-6 border-b text-center">
                            <a href="{{ route('tutors.application-details', $application->id) }}" class="text-blue-500 hover:underline">View Details</a>
                            <!-- If user is an admin create a form to approve or decline application-->
                            @if(Auth::user()->role == 'admin')
                                <td class="py-4 px-6 border-b text-center">       
                                    <form action="{{ route('tutors.approve-application', $application->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-500 text-white py-1 px-3 rounded hover:bg-green-600">Approve</button>
                                    </form>
                                    <form action="{{ route('tutors.reject-application', $application->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">Reject</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout>