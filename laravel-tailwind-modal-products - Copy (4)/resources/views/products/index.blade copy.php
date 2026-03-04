@extends('layouts.productapp')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Product Management</h1>
    </div>
    <div class="max-w-7xl mx-auto mt-1 ">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Suggest Features <a target='_blank'
                        href='https://chatgpt.com/c/697c30d0-c5bc-8320-9f23-45b117441144'>https://chatgpt.com/c/697c30d0-c5bc-8320-9f23-45b117441144</a>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto mt-1 ">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Inventory : <a target='_blank'
                        href='https://chatgpt.com/c/69887317-2164-8321-a3c1-419e2ab520f3'>https://chatgpt.com/c/69887317-2164-8321-a3c1-419e2ab520f3</a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto mt-1 ">
        <div class="mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Product Create : <a target='_blank'
                        href='https://chatgpt.com/c/69777f21-f7b4-8323-981e-974aa1246a5e'>https://chatgpt.com/c/69777f21-f7b4-8323-981e-974aa1246a5e</a>
                </div>
            </div>
        </div>
    </div>




    <!-- TOASTER -->
    <div v-if="toast" class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded">
        @{{ toast }}
    </div>

    <!-- CREATE BUTTON -->


    <div class="flow-root  mt-2">
        <p class="float-left">Products</p>
        <p class="float-right"><button @click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded">
                Add Product
            </button>
        </p>
    </div>


    <!-- MODAL -->
    <div v-if="showModal" class="fixed inset-0 bg-black/40 flex items-center justify-center">
        <div class="bg-white w-full max-w-xl p-6 rounded">

            <div v-if="errors.api_errors"  class="flex gap-4 bg-red-100 p-4 rounded-md">
                <div class="w-max">
                    <div class="h-10 w-10 flex rounded-full bg-gradient-to-b from-red-100 to-red-300 text-red-700">
                        <span class="material-icons material-icons-outlined m-auto" style="font-size:20px">gpp_bad</span>
                    </div>
                </div>
                <div class="space-y-1 text-sm">
                    <h6 class="font-medium text-red-900">Fatal error</h6>
                    <p class="text-red-700 leading-tight">Your internet connection was lost, we can't upload your
                        photo.</p>
                </div>
            </div>


            <h2 class="text-xl mb-4">Create Product</h2>
            <form @submit.prevent="submit">
                <!-- CATEGORY -->
                <select multiple v-model="selectedOptions" class="w-full border rounded p-2 mb-1">
                    <option value="">Select Category</option>
                    <option v-for="c in categoriesList" :value="c.id">@{{ c.cat_name }}</option>
                </select>
                <p class="text-red-500 text-sm" v-if="errors.selectedOptions">@{{ errors.selectedOptions }}</p>
                <!-- NAME -->
                <input v-model="form.name" placeholder="Name" class="w-full border rounded p-2 mt-2">
                <p class="text-red-500 text-sm" v-if="errors.name">@{{ errors.name }}</p>
                <!-- SKU -->
                <input v-model="form.sku" placeholder="SKU" class="w-full border rounded p-2 mt-2">
                <!-- PRICE -->
                <input type="number" v-model="form.price" placeholder="Price" class="w-full border rounded p-2 mt-2">
                <p class="text-red-500 text-sm" v-if="errors.price">@{{ errors.price }}</p>
                <!-- STOCK -->
                <input type="number" v-model="form.stock" placeholder="Stock" class="w-full border rounded p-2 mt-2">
                <p class="text-red-500 text-sm" v-if="errors.stock">@{{ errors.stock }}</p>

                <!-- MAIN IMAGE -->
                <div class="mt-3">
                    <label class="block text-sm font-medium">Main Image</label>
                    <input type="file" accept="image/*" @change="handleMainImage"
                        class="mt-1 block w-full text-sm
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded file:border-0
                                   file:bg-blue-600 file:text-white">

                    <p v-if="errors.main_image" class="text-red-500 text-sm mt-1">
                        @{{ errors.main_image }}
                    </p>
                    <!-- Main Image Preview -->
                    <div v-if="mainPreview" class="mt-3 relative w-32">
                        <img :src="mainPreview" class="rounded border">
                        <button type="button" @click="removeMainImage"
                            class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6">
                            ✕
                        </button>
                    </div>
                </div>
                <!-- SUB IMAGES -->
                <div class="mt-4">
                    <label class="block text-sm font-medium">Sub Images</label>
                    <input type="file" multiple accept="image/*" @change="handleSubImages"
                        class="mt-1 block w-full text-sm
                                   file:mr-4 file:py-2 file:px-4
                                   file:rounded file:border-0
                                   file:bg-gray-700 file:text-white">
                    <div class="grid grid-cols-4 gap-3 mt-3">
                        <div v-for="(img, index) in subPreviews" :key="index" class="relative">
                            <img :src="img" class="rounded border h-24 w-full object-cover">
                            <button type="button" @click="removeSubImage(index)"
                                class="absolute top-1 right-1 bg-black/70 text-white rounded-full w-6 h-6">
                                ✕
                            </button>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-4 gap-2">
                    <button type="button" @click="showModal=false">Cancel</button>
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script type="module">
        import {
            createApp,
            reactive,
            ref,
            onMounted
        } from 'https://unpkg.com/vue@3/dist/vue.esm-browser.js';

        createApp({
            setup() {
                const showModal = ref(false)
                const toast = ref('')
                const categoriesList = ref([])
                const errors = reactive({})
                const mainPreview = ref(null)
                const subPreviews = ref([])

                errors.api_errors = false;

                const handleMainImage = (e) => {
                    const file = e.target.files[0]
                    form.main_image = file
                    mainPreview.value = URL.createObjectURL(file)
                }

                const removeMainImage = () => {
                    form.main_image = null
                    mainPreview.value = null
                }

                const handleSubImages = (e) => {
                    const files = Array.from(e.target.files)
                    files.forEach(file => {
                        form.sub_images.push(file)
                        subPreviews.value.push(URL.createObjectURL(file))
                    })
                }

                const removeSubImage = (index) => {
                    form.sub_images.splice(index, 1)
                    subPreviews.value.splice(index, 1)
                }

                const selectedOptions = ref([]);
                const openModal = () => showModal.value = true

                const form = reactive({
                    categories: [],
                    name: '',
                    sku: '',
                    price: '',
                    stock: '',
                    main_image: null,
                    sub_images: []
                })
                const validate = () => {
                    Object.keys(errors).forEach(k => delete errors[k])
                    //if (selectedOptions.value.length === 0) {
                    //  alert('Please select at least one option.');
                    // return;
                    // }
                    //console.log('Selected:', selectedOptions.value);
                    //return;
                    //if (form.categories.value.length === 0)
                    //    errors.categories = 'Please select a category'
                    if (!form.name) errors.name = 'Product name is required'
                    if (!form.price) errors.price = 'Price is required'
                    if (!form.stock) errors.stock = 'Stock is required'
                    if (!form.main_image) errors.main_image = 'Main image is required'
                    if (!form.name) errors.name = 'Name required'
                    if (!form.price) errors.price = 'Price required'
                    if (!form.main_image) errors.main_image = 'Image required'
                    if (!form.main_image) errors.main_image = 'Main image is required'
                    if (selectedOptions.value.length === 0) errors.selectedOptions = 'Category required'
                    return Object.keys(errors).length === 0
                }

                const submit = async () => {
                    if (!validate()) return
                    const formData = new FormData()
                    formData.append('categories', selectedOptions.value)
                    formData.append('name', form.name)
                    formData.append('sku', form.sku)
                    formData.append('price', form.price)
                    formData.append('stock', form.stock)
                    formData.append('main_image', form.main_image)
                    form.sub_images.forEach((img) => {
                        formData.append('sub_images[]', img)
                    })
                    axios.post('api/product-save', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                Authorization: `Bearer ${window.API_TOKEN}`
                            }
                        }).then(response => {
                            console.log("response.data ----------", response.data);
                            toast.value = 'Product saved successfully 🎉'
                            //showModal.value = false
                            setTimeout(() => toast.value = '', 3000);
                        })
                        .catch(error => {
                            //console.error("error.response.data ----------" ,  error.response.data)
                            console.log("response.data ----------", error.response.data);
                            errors.api_errors = true;
                        });
                    
                }
                onMounted(async () => {
                    categoriesList.value = await fetch('/categories').then(r => r.json())
                })
                return {
                    handleMainImage,
                    removeMainImage,
                    handleSubImages,
                    removeSubImage,
                    mainPreview,
                    subPreviews,
                    showModal,
                    openModal,
                    submit,
                    form,
                    errors,
                    selectedOptions,
                    categoriesList,
                    toast
                }
            }
        }).mount('#app')
    </script>
@endsection
