import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";

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
        category: product.category.name,
        purchase_price: product.purchase_price,
        selling_price: product.selling_price,
        quantity: product.quantity,
        image: "https://www.google.com",
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
                {errors && Object.keys(errors).length > 0 && (
                    <div className="alert alert-danger">
                        <ul>
                            {Object.values(errors).map((error, index) => (
                                <li key={index}>{error}</li>
                            ))}
                        </ul>
                    </div>
                )}{" "}
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-5">
                            <h1 className="mb-2">Edit Product</h1>
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
                                    <InputLabel
                                        htmlFor="Kategori"
                                        value="Kategori"
                                    />
                                    <select
                                        name="category_id"
                                        id="kategori"
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
