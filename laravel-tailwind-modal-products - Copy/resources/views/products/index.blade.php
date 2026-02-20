@extends('layouts.productapp')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
@endpush

@push('js_links')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
@endpush



@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Product Management : https://chatgpt.com/c/697c30d0-c5bc-8320-9f23-45b117441144</h1>
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
    <!-- component -->
    <!-- This is an example component -->
    <div class="max-w-2xl mx-auto bg-white p-16">

        <form>
            <div class="grid gap-6 mb-6 lg:grid-cols-2">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">First
                        name</label>
                    <input type="text" id="first_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="John" required>
                </div>
                <div>
                    <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Last
                        name</label>
                    <input type="text" id="last_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Doe" required>
                </div>
                <div>
                    <label for="company"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Company</label>
                    <input type="text" id="company"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Flowbite" required>
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Phone
                        number</label>
                    <input type="tel" id="phone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                </div>
                <div>
                    <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Website
                        URL</label>
                    <input type="url" id="website"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="flowbite.com" required>
                </div>
                <div>
                    <label for="visitors" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Unique
                        visitors (per month)</label>
                    <input type="number" id="visitors"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" required>
                </div>
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email
                    address</label>
                <input type="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="john.doe@company.com" required>
            </div>
            <div class="mb-6">
                <label for="password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Password</label>
                <input type="password" id="password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="•••••••••" required>
            </div>
            <div class="mb-6">
                <label for="confirm_password"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Confirm password</label>
                <input type="password" id="confirm_password"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="•••••••••" required>
            </div>
            <div class="flex items-start mb-6">
                <div class="flex items-center h-5">
                    <input id="remember" type="checkbox" value=""
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
                        required>
                </div>
                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-400">I agree with the <a
                        href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and
                        conditions</a>.</label>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        <p class="mt-5">These input field components is part of a larger, open-source library of Tailwind CSS components.
            Learn
            more by going to the official <a class="text-blue-600 hover:underline"
                href="https://flowbite.com/docs/getting-started/introduction/" target="_blank">Flowbite
                Documentation</a>.
        </p>
    </div>
    <div v-if="showModal" class="fixed inset-0 bg-black/40 flex items-center justify-center modal-overlay">
        <div class="bg-white w-full max-w-xl p-6 rounded modal-container">

            <div v-if="errors.api_errors" class="flex gap-4 bg-red-100 p-4 rounded-md">
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
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <input v-model="form.name" @input="autoSlug" placeholder="Product name"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.name">@{{ errors.name }}</p>
                    </div>
                    <div>
                        <input v-model="form.sku" placeholder="SKU"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <button type="button" @click="generateSKU" class="btn">Auto</button>
                        <p class="text-red-500 text-sm" v-if="errors.sku">@{{ errors.sku }}</p>
                    </div>
                    <div>
                        <select multiple v-model="selectedOptions"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  w-full border rounded p-2 mb-1">
                            <option value="">Select Category</option>
                            <option v-for="c in categoriesList" :value="c.id">@{{ c.cat_name }}</option>
                        </select>
                        <p class="text-red-500 text-sm" v-if="errors.selectedOptions">@{{ errors.selectedOptions }}</p>
                    </div>
                    <div>
                        <input v-model="form.slug" placeholder="Slug"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.slug">@{{ errors.slug }}</p>
                    </div>
                   

                    <div>
                        <input v-model="form.price" type="number" placeholder="Price"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.price">@{{ errors.price }}</p>
                    </div>
                    <div>
                        <input v-model="form.discount_price" type="number" placeholder="Discount"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.discount_price">@{{ errors.discount_price }}</p>
                    </div>
                    <div>
                    <label class="font-semibold">Stock</label>
                        <input v-model="form.stock" type="number" placeholder="Stock"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.stock">@{{ errors.stock }}</p>
                    </div>
                    <div>
                     <label class="font-semibold">Status</label>
                        <select v-model="form.status"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                            <option value="active">Active</option>
                            <option value="draft">Draft</option>
                        </select>
                        <p class="text-red-500 text-sm" v-if="errors.status">@{{ errors.status }}</p>
                    </div>
                    <div>
                     <label class="font-semibold">SEO Title</label>
                        <input v-model="form.seo_title" placeholder="SEO Title"
                            class="input col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.seo_title">@{{ errors.seo_title }}</p>
                    </div>
                    <div>
                     <label class="font-semibold">Publish Date</label>
                        <input type="date" v-model="form.publish_date"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.publish_date">@{{ errors.publish_date }}</p>
                    </div>

                    <div>
                     <label class="font-semibold">Weight</label>
                        <input v-model="form.weight" placeholder="Weight"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.weight">@{{ errors.weight }}</p>
                    </div>
                    <div>
                     <label class="font-semibold">Full Dimensions</label>
                        <input v-model="form.dimensions" placeholder="Dimensions"
                            class="input bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.dimensions">@{{ errors.dimensions }}</p>
                    </div>


                    <!-- MAIN IMAGE -->
                    <div class="col-span-2">
                        <h3 class="section-title">Main Image</h3>
                        <div class="upload-card" @dragover.prevent @drop.prevent="handleMainDrop">
                            <input type="file" @change="mainImageSelect" class="hidden" ref="mainInput">
                            <div v-if="!mainPreview" class="upload-placeholder" @click="$refs.mainInput.click()">
                                <div class="upload-icon">📤</div>
                                <p class="upload-title">Drop main image here</p>
                                <p class="upload-sub">or click to browse</p>
                                <p class="upload-note">JPG / PNG / WEBP • Max 2MB</p>
                            </div>
                            <div v-else class="preview-wrapper">
                                <img :src="mainPreview" class="preview-large">
                                <button type="button" class="replace-btn" @click="$refs.mainInput.click()">
                                    Replace Image
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- GALLERY -->
                    <div class="col-span-2">
                        <h3 class="section-title">Gallery Images</h3>
                        <div class="upload-card" @dragover.prevent @drop.prevent="galleryDrop">
                            <input type="file" multiple @change="gallerySelect" class="hidden" ref="galleryInput">
                            <div class="upload-placeholder" @click="$refs.galleryInput.click()">
                                <div class="upload-icon">🖼</div>
                                <p class="upload-title">Drop gallery images</p>
                                <p class="upload-sub">Click to upload multiple</p>
                                <p class="upload-note">Max 10 images</p>
                            </div>
                            <div class="gallery-grid" v-if="galleryPreview.length">
                                <div v-for="(img,i) in galleryPreview" :key="i" class="gallery-card">
                                    <img :src="img.url" class="gallery-img">
                                    <div class="gallery-actions">
                                        <button type="button" @click="removeGallery(i)"
                                            class="icon-btn danger">✕</button>
                                        <button type="button" @click="setFeatured(i)"
                                            :class="['icon-btn', img.featured ? 'featured-active' : 'featured']">
                                            ★
                                        </button>
                                    </div>
                                    <div v-if="img.featured" class="featured-badge">Featured</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-span-2">
                     <label class="font-semibold">SEO Description</label>
                        <textarea v-model="form.seo_desc" placeholder="SEO Description"
                            class="input col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm "></textarea>
                        <p class="text-red-500 text-sm" v-if="errors.seo_desc">@{{ errors.seo_desc }}</p>
                    </div>


<div class="col-span-2">
 <label class="font-semibold">Short Description</label>
                        <input v-model="form.short_desc" placeholder="Short description"
                            class="input col-span-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm ">
                        <p class="text-red-500 text-sm" v-if="errors.short_desc">@{{ errors.short_desc }}</p>
                    </div>

                    <div class="col-span-2">
                        <label class="font-semibold">Full Description</label>
                        <div id="editor" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm "></div>
                        <p class="text-red-500 text-sm" v-if="errors.full_desc">@{{ errors.full_desc }}</p>
                    </div>
                    <!-- SUBMIT -->
                   


                   
                    <div class="bg-gray-100 p-4 rounded-lg">
                        <div class="flex gap-4">
                           <button class="submit bg-red-600 text-white px-4 py-2 rounded" type="button"
                            @click="showModal=false">Cancel</button>
                        <button :disabled="loading" class="submit bg-green-600 text-white px-4 py-2 rounded">
                            @{{ loading ? 'Saving...' : 'Create Product' }}
                        </button>
                        </div>
                    </div>


            </form>
        </div>
    </div>
@endsection
