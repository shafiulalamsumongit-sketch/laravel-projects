<!DOCTYPE html>
<html>

<head>
    <title>Product Management</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--   <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <meta name="api-token" content="{{ session('api_token') }}">
    <script>
        window.API_TOKEN = "{{ session('api_token') }}";
    </script>
    {{-- ... other global links ... --}}
    @stack('styles')
    {{-- ... other global links ... --}}
    @stack('js_links')
</head>

<body class="bg-gray-100 min-h-screen">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')
        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <!-- Page Content -->
        <main>
            <div id="app" v-cloak class="p-6 max-w-5xl mx-auto">
                @yield('content')
            </div>
        </main>
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
                const showModal = ref(true)
                const toast = ref('')
                const categoriesList = ref([])
                //const errors = reactive({})
                const subPreviews = ref([])
                ///errors.api_errors = true;
                const loading = ref(false)
                const mainPreview = ref(null)
                const galleryPreview = reactive([])
                const errors = reactive({})

                const setError = (field, msg) => {
                    errors[field] = msg;
                    //errors.field = msg;
                    console.log("field-" + field + "-msg-" + msg);
                }
                const clearErrors = () => Object.keys(errors).forEach(k => delete errors[k])
                const validateForm = () => {
                    clearErrors()
                    //if (!form.name) errors.name = 'Product name is required'
                    if (!form.name.trim()) {
                        setError('name', 'Product name required');
                        errors.name = 'Name required';
                    }
                    if (!form.sku.trim()) setError('sku', 'SKU required');
                    if (!form.short_desc.trim()) setError('short_desc', 'Short description required')
                    const desc = quill?.root?.innerText.trim()
                    if (!desc) {
                        setError('full_desc', 'Description required')
                        errors.full_desc = 'Name required';
                    }
                    if (!form.price || form.price <= 0) setError('price', 'Valid price required')
                    if (form.discount_price && Number(form.discount_price) >= Number(form.price))
                        setError('discount_price', 'Discount must be less than price')
                    if (form.stock === '' || form.stock < 0) setError('stock', 'Stock required')
                    if (!form.slug.trim()) setError('slug', 'Slug required')
                    if (form.seo_title.length == 0) setError('seo_title', 'SEO title required')
                    if (form.seo_title.length > 120) setError('seo_title', 'SEO title too long')
                    if (form.seo_desc.length == 0) setError('seo_desc', 'SEO seo_desc required')
                    if (form.seo_desc.length > 200) setError('seo_desc', 'SEO description too long')
                    if (form.weight === '' || form.weight < 0) setError('weight', 'Invalid weight')
                    if (form.weight && form.weight < 0) setError('weight', 'Invalid weight')
                    if (form.dimensions === '' || form.dimensions < 0) setError('dimensions',
                        'Invalid dimensions')
                    if (form.dimensions && form.dimensions < 0) setError('dimensions', 'Invalid dimensions')
                    if (!form.publish_date) setError('publish_date', 'Publish date required')
                    if (selectedOptions.value.length === 0) errors.selectedOptions = 'Category required'
                    if (!mainPreview.value) setError('main_image', 'Main image required');
                    if (galleryPreview.length === 0)
                        setError('gallery', 'Add at least one gallery image')
                    if (galleryPreview.length > 10)
                        setError('gallery', 'Maximum 10 gallery images')
                    return Object.keys(errors).length === 0
                }

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
                const openModal = () => showModal.value = true;

                const form = reactive({
                    main_image: null,
                    sub_images: [],
                    categories: [],
                    name: '',
                    sku: '',
                    short_desc: '',
                    full_desc: '',
                    price: '',
                    discount_price: '',
                    stock: '',
                    status: 'active',
                    slug: '',
                    seo_title: '',
                    seo_desc: '',
                    weight: '',
                    dimensions: '',
                    publish_date: '',
                    visibility: 'public',
                    tags: ''
                })

                const submitsss = async () => {
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

                let quill
                const slugify = t => t.toLowerCase().replace(/[^a-z0-9]+/g, '-')
                const autoSlug = () => form.slug = slugify(form.name)
                const generateSKU = () => form.sku = 'SKU-' + Math.random().toString(36).substring(2, 8)
                    .toUpperCase()

                const validateImage = f => {
                    if (!['image/jpeg', 'image/png', 'image/webp'].includes(f.type)) return false
                    if (f.size > 2 * 1024 * 1024) return false
                    return true
                }

                const mainImageSelect = e => {
                    const f = e.target.files[0]
                    if (!validateImage(f)) return alert('Invalid main image')
                    mainPreview.value = URL.createObjectURL(f)
                    form.main = f
                }

                const handleMainDrop = e => mainImageSelect({
                    target: {
                        files: e.dataTransfer.files
                    }
                })

                const gallerySelect = e => {
                    for (let f of e.target.files) {
                        if (!validateImage(f) || galleryPreview.length >= 10) continue
                        galleryPreview.push({
                            file: f,
                            url: URL.createObjectURL(f),
                            featured: false
                        })
                    }
                }

                const galleryDrop = e => gallerySelect({
                    target: {
                        files: e.dataTransfer.files
                    }
                })

                const removeGallery = i => galleryPreview.splice(i, 1)

                const setFeatured = i => {
                    galleryPreview.forEach(g => g.featured = false)
                    galleryPreview[i].featured = true
                }

                const submit = async () => {

                    if (!validateForm()) {
                        console.log('Please fix validation errors');
                        //success()  //return
                    }

                    loading.value = true
                    form.full_desc = quill.root.innerHTML;
                    const formData = new FormData()
                    Object.entries(form).forEach(([k, v]) => formData.append(k, v))
                    if (form.main) formData.append('main_image', form.main);
                    galleryPreview.forEach((g, i) => {
                        formData.append('gallery[]', g.file)
                        formData.append('featured_index', galleryPreview.findIndex(x => x.featured))
                    });
                    axios.post('api/product-save', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                                Authorization: `Bearer ${window.API_TOKEN}`
                            }
                        }).then(response => {
                            console.log("success response.data ----------", response.data);
                            toast.value = 'Product saved successfully 🎉'
                            setTimeout(() => toast.value = '', 3000);
                        })
                        .catch(error => {
                            if (error.response.status === 422) {
                                console.log('error.response.data.errors --1001----', error.response.data
                                .errors);
                            }
                            errors.api_errors = true;
                            console.log("error.response.data------1002----", error.response.data.errors);
                        });
                    loading.value = false
                }

                const success = () => {
                    toast.value = 'Product saved!'
                    setTimeout(() => toast.value = '', 2000)
                    Object.keys(form).forEach(k => form[k] = '')
                    galleryPreview.splice(0)
                    mainPreview.value = null;
                    form.status = 'active';
                    form.visibility = 'public';
                    quill.setText('')
                }

                onMounted(async () => {
                    quill = new Quill('#editor', {
                        theme: 'snow'
                    });
                    categoriesList.value = await fetch('/categories').then(r => r.json())
                })

                return {
                    selectedOptions,
                    categoriesList,
                    showModal,
                    form,
                    errors,
                    loading,
                    toast,
                    mainPreview,
                    galleryPreview,
                    autoSlug,
                    generateSKU,
                    mainImageSelect,
                    handleMainDrop,
                    gallerySelect,
                    galleryDrop,
                    removeGallery,
                    setFeatured,
                    submit,
                    openModal,

                }
            }
        }).mount('#app')
    </script>
</body>

</html>
