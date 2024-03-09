import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import AddCategory from './Partials/AddCategory';
import { Head, Link } from '@inertiajs/react';
import { useState } from 'react';
import { router } from '@inertiajs/react'

export default function Categories({categories, auth, errors}) {
    const [show, setShow] = useState(false);

    // const [errors, setErrors] = useState([]);
    const toggleAddCategory = () => {
        setShow(prevState => !prevState);
    }
    console.log(errors)
    console.log(typeof categories)

    const deleteCategory = async (id) => {
        router.delete(`/categories/delete/${id}`);
    }
    return (
        <AuthenticatedLayout
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>}
        >
            <div>
            {errors && errors.message && (
                <div className="alert alert-danger">
                    {errors.message}
                </div>
            )}
            </div>
            <Head title="Categories" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <div className="p-6">
                            <div className='flex justify-between mb-5'>
                                <h1 className='text-xl font-bold'>Daftar Product</h1>
                                <button className='px-2 py-1 rounded-md bg-green-800 text-white' onClick={toggleAddCategory}>Tambah</button>
                            </div>
                            <table className='table-auto rounded-md w-full border-collapse border border-slate-500'>
                                <thead>
                                    <tr className='text-start'>
                                        <th className='border border-slate-600'>Id</th>
                                        <th className='border border-slate-600'>Nama</th>
                                        <th className='border border-slate-600'>Image</th>
                                        <th className='border border-slate-600'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        categories ? categories.map((item, index) => (
                                            <tr key={index}>
                                                <td className='p-2 border border-slate-600'>{ index + 1 }</td>
                                                <td className='p-2 border border-slate-600'>{ item.name }</td>
                                                <td className='p-2 border border-slate-600'>
                                                    <div className='flex justify-center'>
                                                        <img src={ item.image } className='w-[80px]'  alt="" />
                                                    </div>
                                                </td>
                                                <td className='border border-slate-600'>
                                                    <div className='p-2 flex justify-center gap-2'>
                                                        <button type="button" className='px-2 py-2 rounded-md bg-red-800 text-white' onClick={() => deleteCategory(item.id)}>delete</button>
                                                        <Link href={route('category.edit', item.id)} className='px-2 py-2 rounded-md bg-green-800 text-white'>
                                                            edit
                                                        </Link>
                                                    </div>
                                                </td>
                                            </tr>
                                        )) : (
                                            <tr>
                                                <td colSpan={7}>
                                                    Tidak ada data
                                                </td>
                                            </tr>
                                        )
                                    }
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <AddCategory show={show} onClose={toggleAddCategory} categories={categories} />
        </AuthenticatedLayout>
    );
}
