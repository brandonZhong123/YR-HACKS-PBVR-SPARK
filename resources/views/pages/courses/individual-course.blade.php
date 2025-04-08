<x-layout :pageHeading="'hello' ">
    <?php
    $grade = 0;
    $totalWeightAbundance = 0;

    for ($i = 0; $i < count($individualCourse->assessments); $i++) {
        $totalWeightAbundance += $individualCourse->assessments[$i]->weight;
    }
    ?>
    <div class="flex justify-center items-center h-screen bg-gray-100 p-4">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl border border-gray-300 text-center">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">{{$individualCourse->course->code}}</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full border-collapse mt-4">
                    <thead>
                        <tr class="bg-purple-500 text-white">
                            <th class="p-3 ">Assessment</th>
                            <th class="p-3 ">Grade</th>
                            <th class="p-3 ">Weight</th>
                            <th class="p-3 ">Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($individualCourse->assessments as $assessment)
                            <tr class="border-b bg-gray-50 hover:bg-purple-100 transition">
                                <?php
                                $grade += $assessment->mark * ($assessment->weight / $totalWeightAbundance)
                                ?>
                                <td class="p-3">{{$assessment->name}}</td>
                                <td class="p-3">{{$assessment->mark}}</td>
                                <td class="p-3">{{$assessment->weight}}</td>
                                <td class="p-3">{{$assessment->feedback}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6 p-4 bg-purple-100 rounded-lg text-lg font-semibold text-gray-800">
                Current Grade: <span class="text-purple-500 font-bold">{{round($grade, 2 )}}%</span>
            </div>
        </div>
    </div>
</x-layout>