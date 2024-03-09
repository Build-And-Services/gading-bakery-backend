import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm, router } from "@inertiajs/react";


const EditProduct = ({ product, categories, auth, errors }) => {
    const {
        data,
        setData,
        post,
        processing,
        errors: error,
        reset,
    } = useForm({
        name: product.name,
        product_code: product.product_code,
        category: product.category.name,
        purchase_price: product.purchase_price,
        selling_price: product.selling_price,
        quantity: product.quantity,
        image: product.image,
        category_id: categories.id,
    });

    const submit = (e) => {
        e.preventDefault();
        // console.log('submit');
        post(route("product.update", product.id));
    };
    return (
        <AuthenticatedLayout
            auth={auth}
            // errors={errors}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Product
                </h2>
            }
        >
            <Head title="Products" />
            <div className="py-12">
            <div>
            {errors && errors.message && (
                <div className="alert alert-danger">
                    {errors.message}
                </div>
            )}
            </div>
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-5">
                            <div className='flex justify-between mb-5'>
                                <h1 className='text-xl font-bold'>Edit Product</h1>
                                <Link href={route('product.index')} className='px-2 py-1 rounded-md bg-green-800 text-white'>Back</Link>
                            </div>
                            <form onSubmit={submit}>
                                <div className="mb-5">
                                    <InputLabel htmlFor="name" value="Name" />
                                    <TextInput
                                        value={data.name}
                                        onChange={(e) =>
                                            setData({
                                                ...data,
                                                name: e.target.value,
                                            })
                                        }
                                        id="name"
                                        className="mt-1 block w-full"
                                        required
                                        isFocused
                                        autoComplete="name"
                                    />
                                    <InputError className="mt-2" />
                                </div>
                                <div className="mb-5">
                                    <InputLabel htmlFor="product_code" value="Product Code" />
                                    <TextInput
                                        value={data.product_code}
                                        onChange={(e) =>
                                            setData({
                                                ...data,
                                                product_code: e.target.value,
                                            })
                                        }
                                        id="product_code"
                                        className="mt-1 block w-full"
                                        required
                                        isFocused
                                        autoComplete="product_code"
                                    />
                                    <InputError className="mt-2" />
                                </div>
                                <div className="mb-5">
                                    <InputLabel
                                        htmlFor="quantity"
                                        value="Quantity"
                                    />
                                    <TextInput
                                        type="number"
                                        min={1}
                                        value={data.quantity}
                                        onChange={(e) =>
                                            setData({
                                                ...data,
                                                quantity: e.target.value,
                                            })
                                        }
                                        id="name"
                                        className="mt-1 block w-full"
                                        required
                                        isFocused
                                        autoComplete="name"
                                    />
                                    <InputError className="mt-2" />
                                </div>
                                <div className="mb-5">
                                    <InputLabel htmlFor="image" value="Image" />
                                    <TextInput
                                        type="hidden"
                                        min={1}
                                        value={data.image}
                                        onChange={(e) =>
                                            setData({
                                                ...data,
                                                image: e.target.value,
                                            })
                                        }
                                        id="image"
                                        className="mt-1 block w-full"
                                        required
                                        isFocused
                                        autoComplete="image"
                                    />
                                    <div className="flex items-center">
                                        <p className='mr-3'>Old Image : </p>
                                        <img src={product.image} className='w-[80px] my-2' alt="Image" />
                                    </div>
                                    <input
                                        type="file"
                                        onChange={(e) =>
                                            setData({
                                                ...data,
                                                image: e.target.files[0], // Mengambil file dari input
                                            })
                                        }
                                    />
                                    <InputError className="mt-2" />
                                </div>
                                <div className="mb-5">
                                    <InputLabel
                                        htmlFor="Kategori"
                                        value="Kategori"
                                    />
                                    <select
                                        onChange={(e) =>
                                            setData({
                                                ...data,
                                                category_id: e.target.value,
                                            })
                                        }
                                        name="category_id"
                                        value={data.category_id}
                                        id="category_id"
                                        className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    >
                                        {categories.map((item, index) => (
                                            <option key={index} value={item.id}>
                                                {item.name}
                                            </option>
                                        ))}
                                    </select>
                                    <InputError className="mt-2" />
                                </div>

                                <div className="flex gap-3 mb-5">
                                    <div className="flex-1">
                                        <InputLabel
                                            htmlFor="name"
                                            value="Harga Jual"
                                        />
                                        <TextInput
                                            value={data.selling_price}
                                            onChange={(e) =>
                                                setData({
                                                    ...data,
                                                    selling_price:
                                                        e.target.value,
                                                })
                                            }
                                            className="mt-1 block w-full"
                                            required
                                            autoComplete="selling_price"
                                        />
                                        <InputError className="mt-2" />
                                    </div>
                                    <div className="flex-1">
                                        <InputLabel
                                            htmlFor="name"
                                            value="Harga Dasar"
                                        />
                                        <TextInput
                                            value={data.purchase_price}
                                            onChange={(e) =>
                                                setData({
                                                    ...data,
                                                    purchase_price:
                                                        e.target.value,
                                                })
                                            }
                                            className="mt-1 block w-full"
                                            required
                                            autoComplete="purchase_price"
                                        />
                                        <InputError className="mt-2" />
                                    </div>
                                </div>

                                <div className="mb-5 flex gap-2">
                                    <button
                                        className="rounded-md bg-green-700 text-white px-5 py-2"
                                        type="submit"
                                    >
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default EditProduct;
