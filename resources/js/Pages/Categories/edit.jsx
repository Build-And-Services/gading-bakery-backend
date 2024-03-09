import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm, router } from "@inertiajs/react";


const EditCategory = ({ category, auth, errors }) => {
    const {
        data,
        setData,
        post,
        processing,
        errors: error,
        reset,
    } = useForm({
        name: category.name,
        image: category.image,
    });

    const submit = (e) => {
        e.preventDefault();
        // console.log('submit');
        post(route("category.update", category.id));
    };
    return (
        <AuthenticatedLayout
            auth={auth}
            // errors={errors}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Category
                </h2>
            }
        >
            <Head title="Category" />
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
                                <h1 className='text-xl font-bold'>Edit Category</h1>
                                <Link href={route('category.index')} className='px-2 py-1 rounded-md bg-green-800 text-white'>Back</Link>
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
                                    <InputLabel htmlFor="image" value="Image" />
                                    <div className="flex items-center">
                                        <p className='mr-3'>Old Image : </p>
                                        <img src={category.image} className='w-[80px] my-2' alt="Image" />
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

export default EditCategory;
