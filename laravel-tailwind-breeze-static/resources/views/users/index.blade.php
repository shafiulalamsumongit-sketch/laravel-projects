<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <script src="https://unpkg.com/vue@3/dist/vue.esm-browser.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<div id="app">
    <h2>User Management</h2>

    <form @submit.prevent="saveUser">
        <input v-model="form.name" placeholder="Name">
        <input v-model="form.email" placeholder="Email">
        <button>Update</button>
    </form>

    <hr>

    <table border="1" width="50%">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>

        <tr v-for="user in users" :key="user.id">
            <td>@{{ user.id }} id</td>
            <td>@{{ user.email }}</td>
            <td>
                <button @click="editUser(user)">Edit</button>
                <button @click="deleteUser(user.id)">Delete</button>
            </td>
        </tr>
    </table>
</div>

<script type="module">
import { createApp, ref, onMounted } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';

createApp({
    setup() {
        const users = ref([]);
        const form = ref({ name: '', email: '' });
        const editMode = ref(false);
        const userId = ref(null);

        const fetchUsers = async () => {
            users.value = (await axios.get('/api/users')).data;
        };

        const saveUser = async () => {
            if (editMode.value) {
                await axios.put(`/api/users/${userId.value}`, form.value);
            } else {
                await axios.post('/api/users', form.value);
            }

            resetForm();
            fetchUsers();
        };

        const editUser = (user) => {
            editMode.value = true;
            userId.value = user.id;
            form.value = { name: user.name, email: user.email };
        };

        const deleteUser = async (id) => {
            if (confirm('Delete user?')) {
                await axios.delete(`/api/users/${id}`);
                fetchUsers();
            }
        };

        const resetForm = () => {
            form.value = { name: '', email: '' };
            editMode.value = false;
            userId.value = null;
        };

        onMounted(fetchUsers);

        return {
            users,
            form,
            editMode,
            saveUser,
            editUser,
            deleteUser
        };
    }
}).mount('#app');
</script>

</body>
</html>
