<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 mb-8">Student Management System</h1>

            {{-- ================= ADD NEW STUDENT ================= --}}
            
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Add New Student</h2>
                <form action="/students" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Student Name">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                        <input type="number" name="age" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Age">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Email">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                        <input type="text" name="address" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Address">
                    </div>
                    <div> 
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="md:col-span-2 w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200">Add Student</button>
                </form>
            </div>

            {{-- ================= ALL STUDENTS ================= --}}
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">All Students</h2>

                @if($students->isEmpty())
                    <p class="text-gray-500">No students found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 border-b">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">ID</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Name</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700 hidden sm:table-cell">Age</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700 hidden md:table-cell">Address</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Email</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-700">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="px-4 py-3 text-gray-900">{{ $student->id }}</td>
                                        <td class="px-4 py-3 text-gray-900">{{ $student->name }}</td>
                                        <td class="px-4 py-3 text-gray-700 hidden sm:table-cell">{{ $student->age }}</td>
                                        <td class="px-4 py-3 text-gray-700 hidden md:table-cell">{{ $student->address }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $student->email }}</td>
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $student->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $student->status ? 'Active' : 'Inactive' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>


    
            {{-- ================= UPDATE / DELETE DEMO ================= --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-2xl font-semibold text-gray-900 mb-6">Student Actions</h2>

                <div class="space-y-4">
                    @foreach($students as $student)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 p-4 border rounded-lg hover:bg-gray-50 transition">
                            <div class="sm:col-span-2 md:col-span-1">
                                <p class="text-sm text-gray-600">Student Name</p>
                                <p class="font-semibold text-gray-900">{{ $student->name }}</p>
                            </div>
                            
                            {{-- DELETE --}}
                            <form action="/students/{{ $student->id }}" method="POST" class="flex items-center justify-start sm:justify-end">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full sm:w-auto px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition duration-200">Delete</button>
                            </form>

                            {{-- UPDATE --}}
                            <button type="button" onclick="document.getElementById('modal-{{ $student->id }}').classList.remove('hidden')" class="w-full sm:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-200">
                                Update
                            </button>

                            {{-- UPDATE MODAL --}}
                            <div id="modal-{{ $student->id }}" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden" onclick="this.classList.add('hidden')">
                                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white" onclick="event.stopPropagation()">
                                    <div class="mt-3">
                                        <h3 class="text-lg font-medium text-gray-900 mb-4">Update Student</h3>
                                        <form action="/students/{{ $student->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="grid grid-cols-1 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                                    <input type="text" name="name" value="{{ $student->name }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Age</label>
                                                    <input type="number" name="age" value="{{ $student->age }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                                    <input type="email" name="email" value="{{ $student->email }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                                    <input type="text" name="address" value="{{ $student->address }}" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                                    <select name="status" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                        <option value="1" {{ $student->status ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ !$student->status ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="flex justify-end mt-4">
                                                <button type="button" onclick="document.getElementById('modal-{{ $student->id }}').classList.add('hidden')" class="mr-2 px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 text-sm font-medium rounded-lg transition duration-200">Cancel</button>
                                                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-200">Update Student</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-6">
                    <a href="/students/active" class="text-blue-600 hover:underline">View Active Students</a> | 
                    <a href="/students/inactive" class="text-blue-600 hover:underline">View Inactive Students</a>
                </div>

            </div>
        </div>
        
    </div></body>
</html>