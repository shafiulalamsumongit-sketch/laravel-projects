@extends('layouts.apptailwind')

@section('content')
<div id="app" v-cloak class=' mx-auto mt-10  pb-10'>
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">User Management</h1>
    </div>

    <div class="mx-auto mt-10 ">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    https://chatgpt.com/c/6974afb5-6c98-8322-946c-30c8f7dfaf1c
                </div>
            </div>
        </div>
    </div>

    <div class=" mx-auto mt-10 grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Total Users</p>
            <p class="text-2xl font-bold text-gray-800"> @{{ totalUsers }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Active Users</p>
            <p class="text-2xl font-bold text-green-600">@{{ users.length.toLocaleString() }}</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Admins</p>
            <p class="text-2xl font-bold text-indigo-600">12</p>
        </div>
        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Suspended</p>
            <p class="text-2xl font-bold text-red-600">23</p>
        </div>
    </div>


    <div class=" mx-auto mt-10  pb-10">
        <h2 class="text-2xl font-bold mb-4">User Listing</h2>
        <div class="pb-10">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <!-- Example Row -->
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">1</td>
                            <td class="px-6 py-4 whitespace-nowrap">John Doe</td>
                            <td class="px-6 py-4 whitespace-nowrap">john@example.com</td>
                            <td class="px-6 py-4 whitespace-nowrap">Admin</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                <!-- View Icon -->
                                <button class="text-blue-500 hover:text-blue-700" title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                <!-- Edit Icon -->
                                <button class="text-green-500 hover:text-green-700" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5m-5-9l5 5M16 3l5 5-12 12H4v-5L16 3z" />
                                    </svg>
                                </button>
                                <!-- Delete Icon -->
                                <button class="text-red-500 hover:text-red-700" title="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4a1 1 0 011 1v1H9V4a1 1 0 011-1z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="grid gap-4">
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto border rounded">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Email</th>
                            <th class="px-4 py-2">Role</th>
                            <th class="px-4 py-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-4 py-2">John Doe</td>
                            <td class="px-4 py-2 text-gray-600">john@example.com</td>
                            <td class="px-4 py-2">Admin</td>
                            <td class="px-4 py-2 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                        ✏️ <span class="hidden md:inline">Edit</span>
                                    </button>
                                    <button class="flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                        🗑 <span class="hidden md:inline">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2">Jane Smith</td>
                            <td class="px-4 py-2 text-gray-600">jane@example.com</td>
                            <td class="px-4 py-2">User</td>
                            <td class="px-4 py-2 text-right">
                                <div class="flex justify-end gap-2">
                                    <button class="flex items-center gap-1 px-3 py-1.5 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                                        ✏️ <span class="hidden md:inline">Edit</span>
                                    </button>
                                    <button class="flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                        🗑 <span class="hidden md:inline">Delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden flex flex-col gap-4">
                <!-- Card -->
                <div class="border rounded shadow p-4 bg-white flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg">John Doe</span>
                        <div class="flex gap-2">
                            <button class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700">
                                ✏️
                            </button>
                            <button class="w-10 h-10 flex items-center justify-center bg-red-600 text-white rounded-full hover:bg-red-700">
                                🗑
                            </button>
                        </div>
                    </div>
                    <div class="text-gray-600">john@example.com</div>
                    <div class="text-gray-800 font-medium">Admin</div>
                </div>

                <!-- Another Card -->
                <div class="border rounded shadow p-4 bg-white flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <span class="font-bold text-lg">Jane Smith</span>
                        <div class="flex gap-2">
                            <button class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full hover:bg-blue-700">
                                ✏️
                            </button>
                            <button class="w-10 h-10 flex items-center justify-center bg-red-600 text-white rounded-full hover:bg-red-700">
                                🗑
                            </button>
                        </div>
                    </div>
                    <div class="text-gray-600">jane@example.com</div>
                    <div class="text-gray-800 font-medium">User</div>
                </div>
            </div>
        </div>
    </div>



    <!-- User listing -->
    <div class="mx-auto mt-10  pb-10">
        <div class="flex justify-between items-center mb-4">
            <input v-model="search" placeholder="Search users..." class="border px-3 py-2 rounded w-1/3">
            <button @click="addModal=true" class="bg-blue-600 text-white px-4 py-2 rounded">
                + Add User
            </button>
        </div>
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
            <table class="w-full table-fixed border-collapse border border-gray-200">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Role</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <tr v-if="loading" v-for="i in 5" :key="i">
                        <td colspan="5" class="p-4">
                            <div class="animate-pulse h-4 bg-gray-200 rounded"></div>
                        </td>
                    </tr>
                    <tr v-else v-for="u in users" :key="u.id" class="hover:bg-gray-100 transition-colors duration-200">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <img src="https://i.pravatar.cc/40" class="h-10 w-10 rounded-full">
                            <div>
                                <p class="font-semibold text-gray-800">@{{ u.name }}</p>
                                <p class="text-xs text-gray-500">Joined Jan 12, 2025</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            @{{ u.email }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">
                                Admin
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Active
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="inline-flex gap-2">
                                <button class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                                    View
                                </button>



                                <button @click="openEdit(u.id)" class="flex items-center gap-1 px-2 py-1.5
         bg-blue-600 text-white rounded
         hover:bg-blue-700
         text-sm">
                                    <!-- Icon always visible -->
                                    <span>✏️</span>
                                    <!-- Text only on md+ screens -->
                                    <span class="hidden md:inline">Edit</span>
                                </button>

                                <!-- Example: Delete button -->
                                <button @click="destroy(u.id)" class="flex items-center gap-1 px-2 py-1.5
         bg-red-600 text-white rounded
         hover:bg-red-700
         text-sm">
                                    <span>🗑</span>
                                    <span class="hidden md:inline">Delete</span>
                                </button>


                            </div>
                        </td>
                    </tr>
                    <!-- Optional: show "No records" when empty -->
                    <tr v-if="!loading && users.length === 0">
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            No users found.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--  <div class="flex justify-between items-center p-4">
                        <span class="text-sm text-gray-600">
                            Page @{{ pagination.current_page }} of @{{ pagination.last_page }}
                        </span>
                        <div class="space-x-2">
                            <button v-for="page in pagination.last_page" :key="page" @click="fetchUsers(page)"
                                class="px-3 py-1 border rounded" :class="page === pagination.current_page ?
                                    'bg-blue-600 text-white' :
                                    'bg-white'">
                                @{{ page }}
                            </button>
                        </div>
                    </div> -->
        <div class="flex justify-between items-center mt-4 px-2">
            <!-- Info -->
            <span class="text-sm text-gray-600">
                Showing @{{ pagination.from }} to @{{ pagination.to }} of @{{ pagination.total }} users
            </span>
            <!-- Page Buttons -->
            <div class="flex space-x-1">
                <!-- Previous -->
                <button :disabled="pagination.current_page <= 1" @click="fetchUsers(pagination.current_page - 1)" class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50">
                    Prev
                </button>
                <!-- Page Numbers -->
                <button v-for="page in pagination.last_page" :key="page" @click="fetchUsers(page)" class="px-3 py-1 border rounded hover:bg-gray-100" :class="page === pagination.current_page ? 'bg-blue-600 text-white' : ''">
                    @{{ page }}
                </button>
                <!-- Next -->
                <button :disabled="pagination.current_page >= pagination.last_page" @click="fetchUsers(pagination.current_page + 1)" class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50">
                    Next
                </button>
            </div>
        </div>
    </div>


    <!-- Add User Modal -->
    <div v-if="addModal" class="fixed inset-0 bg-black/40 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Add User</h3>
            <input v-model="form.name" placeholder="Name" class="border rounded w-full px-3 py-2 mb-3">
            <input v-model="form.email" placeholder="Email" class="border rounded w-full px-3 py-2 mb-3">
            <input v-model="form.password" type="password" placeholder="Password" class="border rounded w-full px-3 py-2 mb-3">
            <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password" class="border rounded w-full px-3 py-2 mb-4">
            <div class="flex justify-end gap-2">
                <button @click="addModal=false" class="px-4 py-2 border rounded">
                    Cancel
                </button>
                <button @click="store" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Save
                </button>
            </div>
        </div>
    </div>



    <!-- Edit Modal -->
    <div v-if="editModal" class="fixed inset-0 bg-black/40 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Edit User</h3>

            <input v-model="editForm.name" class="border rounded w-full px-3 py-2 mb-3">

            <input v-model="editForm.email" class="border rounded w-full px-3 py-2 mb-4">

            <div class="flex justify-end gap-2">
                <button @click="editModal=false" class="px-4 py-2 border rounded">
                    Cancel
                </button>
                <button @click="update" class="px-4 py-2 bg-blue-600 text-white rounded">
                    Update
                </button>
            </div>
        </div>
    </div>
    <!-- Toast -->
    <div v-if="toast" class="fixed bottom-5 right-5 bg-green-900 text-white px-4 py-2 rounded shadow">
        @{{ toast }}
    </div>
</div>
<script type="module">
    // const { createApp, ref, onMounted, watch } = Vue
        import {
            createApp,
            ref,
            onMounted,
            watch
        } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'
        ///import { useUsers } from '/resources/js/composables/useUsers.js'
        createApp({
            setup() {
                const users = ref([])
                ///const form = ref({ name: '', email: '' })
                const editForm = ref({})
                const editModal = ref(false)
                const toast = ref('')
                const addModal = ref(false)
                const form = ref({
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation: ''
                })
                //const users = ref([])
                const pagination = ref({})
                const search = ref('')
                let debounceTimer = null
                const loading = ref(false)
                const totalUsers = ref(0)

                axios.defaults.headers.common['X-CSRF-TOKEN'] =
                    document.querySelector('meta[name=csrf-token]').content

                const refreshTotalUsers = async () => {
                    const r = await axios.get('/users/list', {
                        params: {
                            page: 1
                        }
                    })
                    totalUsers.value = r.data.total
                }


                const fetchUsers = (page = 1) => {
                    loading.value = true
                    axios.get('/users/list', {
                        params: {
                            page,
                            search: search.value
                        }
                    }).then(r => {
                        users.value = r.data.data
                        pagination.value = r.data
                        totalUsers.value = r.data.total
                    }).finally(() => loading.value = false)
                }

                // 🔥 LIVE SEARCH WITH DEBOUNCE
                watch(search, () => {
                    clearTimeout(debounceTimer)
                    debounceTimer = setTimeout(() => {
                        fetchUsers()
                    }, 500)
                })

                const notify = msg => {
                    toast.value = msg
                    setTimeout(() => toast.value = '', 20010)
                }

                const toastM = (message, type = 'success') => {
                    window.Toastify({
                        text: message,
                        duration: 2500,
                        gravity: "top",
                        position: "right",
                        close: true,
                        style: {
                            background: type === 'success' ?
                                "#16a34a" :
                                "#dc2626"
                        }
                    }).showToast()
                }

                const store = () => {
                    axios.post('/users/store', form.value).then(() => {
                        notify('User added')
                        toastM('User added')
                        addModal.value = false
                        form.value = {
                            name: '',
                            email: '',
                            password: '',
                            password_confirmation: ''
                        }
                        fetchUsers()
                        refreshTotalUsers()
                    }).catch(e => {
                        alert(Object.values(e.response.data.errors)[0][0])
                    })
                }
                const openEdit = id =>
                    axios.get(`/users/${id}/edit`).then(r => {
                        editForm.value = r.data
                        editModal.value = true
                    })

                const update = () =>
                    axios.post(`/users/${editForm.value.id}/update`, editForm.value)
                    .then(() => {
                        editModal.value = false
                        toastM('User updated')
                        notify('User updated')
                        fetchUsers()
                    })

                const destroyhh = id => {
                    if (confirm('Delete user?')) {
                        axios.delete(`/users/${id}/delete`).then(() => {
                            toastM('User deleted')
                            //notify('User deleted')
                            fetchUsers()
                        })
                    }
                }
                const destroy = id => {
                    Swal.fire({
                        title: 'Delete user?',
                        icon: 'warning',
                        showCancelButton: true
                    }).then(result => {
                        if (result.isConfirmed) {
                            axios.delete(`/users/${id}/delete`).then(() => {
                                toastM('User deleted')
                                fetchUsers()
                            })
                        }
                    })
                }
                /// onMounted(fetchUsers)
                onMounted(() => {
                    addModal.value = false;
                    editModal.value = false;
                    fetchUsers();
                })
                return {
                    search,
                    pagination,
                    addModal,
                    fetchUsers,
                    loading,
                    totalUsers,
                    users,
                    form,
                    editForm,
                    editModal,
                    toast,
                    store,
                    openEdit,
                    update,
                    destroy
                }
            }
        }).mount('#app')
    </script>
@endsection
