@extends('layouts.vueapp')

@section('content')
    <div class='max-w-7xl mx-auto mt-10  pb-10' id="app">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">User Management</h1>
        </div>
        <div class="max-w-7xl mx-auto mt-10 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-sm text-gray-500">Total Users</p>
                <p class="text-2xl font-bold text-gray-800">1,248</p>
            </div>
            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-sm text-gray-500">Active Users</p>
                <p class="text-2xl font-bold text-green-600">1,032</p>
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
        <div class="max-w-7xl mx-auto mt-10  pb-10">
            <div class="flex justify-between items-center mb-4">
                <input v-model="search" placeholder="Search users..." class="border px-3 py-2 rounded w-1/3">
                <button @click="addModal=true" class="bg-blue-600 text-white px-4 py-2 rounded">
                    + Add User
                </button>
            </div>
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <table class="min-w-full text-sm">
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
                        

                        <tr v-else v-for="u in users" :key="u.id" class="hover:bg-gray-50">
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
                                    <button @click="openEdit(u.id)" class="px-3 py-1 border rounded-lg hover:bg-gray-100">
                                        Edit
                                    </button>
                                    <button @click="destroy(u.id)"
                                        class="px-3 py-1 border rounded-lg text-red-600 hover:bg-red-50">
                                        Delete
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
            <div class="flex justify-between items-center p-4">
                <span class="text-sm text-gray-600">
                    Page @{{ pagination.current_page }} of @{{ pagination.last_page }}
                </span>
                <div class="space-x-2">
                    <button v-for="page in pagination.last_page" :key="page" @click="fetchUsers(page)"
                        class="px-3 py-1 border rounded" :class="page === pagination.current_page
                                        ? 'bg-blue-600 text-white'
                                        : 'bg-white'">
                        @{{ page }}
                    </button>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 px-2">
    <!-- Info -->
    <span class="text-sm text-gray-600">
        Showing @{{ pagination.from }} to @{{ pagination.to }} of @{{ pagination.total }} users
    </span>

    <!-- Page Buttons -->
    <div class="flex space-x-1">
        <!-- Previous -->
        <button
            :disabled="pagination.current_page <= 1"
            @click="fetchUsers(pagination.current_page - 1)"
            class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50">
            Prev
        </button>

        <!-- Page Numbers -->
        <button
            v-for="page in pagination.last_page"
            :key="page"
            @click="fetchUsers(page)"
            class="px-3 py-1 border rounded hover:bg-gray-100"
            :class="page === pagination.current_page ? 'bg-blue-600 text-white' : ''">
            @{{ page }}
        </button>

        <!-- Next -->
        <button
            :disabled="pagination.current_page >= pagination.last_page"
            @click="fetchUsers(pagination.current_page + 1)"
            class="px-3 py-1 border rounded hover:bg-gray-100 disabled:opacity-50">
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

                <input v-model="form.password" type="password" placeholder="Password"
                    class="border rounded w-full px-3 py-2 mb-3">

                <input v-model="form.password_confirmation" type="password" placeholder="Confirm Password"
                    class="border rounded w-full px-3 py-2 mb-4">

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


        import {  createApp, ref, onMounted, watch  } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js'
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

                axios.defaults.headers.common['X-CSRF-TOKEN'] =
                    document.querySelector('meta[name=csrf-token]').content

                const fetchUsers = (page = 1) => {
                    loading.value = true

                    axios.get('/users/list', {
                        params: { page, search: search.value }
                    }).then(r => {
                        users.value = r.data.data
                        pagination.value = r.data
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
            background: type === 'success'
                ? "#16a34a"
                : "#dc2626"
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
                onMounted(fetchUsers)

                return {
                    search, pagination, addModal, fetchUsers, loading,
                    users, form, editForm, editModal, toast,
                    store, openEdit, update, destroy
                }
            }
        }).mount('#app')
    </script>
@endsection