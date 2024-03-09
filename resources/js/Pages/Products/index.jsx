import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';
import { useState } from 'react';
import AddProduct from './Partials/AddProduct';
import { router } from '@inertiajs/react'

export default function Products({ products, categories, auth, errors }) {
    const [show, setShow] = useState(false);
    // const [errors, setErrors] = useState([]);
    const toggleAddProduct = () => {
        setShow(prevState => !prevState);
    }
    console.log(errors)

    const deleteProduct = async (id) => {
        router.delete(`/products/delete/${id}`);
    }

    return (
        <AuthenticatedLayout
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Product</h2>}
        >
            <div>
            {errors && errors.message && (
                <div className="alert alert-danger">
                    {errors.message}
                </div>
            )}
            </div>
            <Head title="Products" />


            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <div className="p-6">
                            <div className='flex justify-between mb-5'>
                                <h1 className='text-xl font-bold'>Daftar Product</h1>
                                <button className='px-2 py-1 rounded-md bg-green-800 text-white' onClick={toggleAddProduct}>Tambah</button>
                            </div>
                            <table className='table-auto rounded-md w-full'>
                                <thead>
                                    <tr className='text-start'>
                                        <th className='border border-slate-600'>Id</th>
                                        <th className='border border-slate-600'>Nama</th>
                                        <th className='border border-slate-600'>Kode Produk</th>
                                        <th className='border border-slate-600'>Category</th>
                                        <th className='border border-slate-600'>Harga Jual</th>
                                        <th className='border border-slate-600'>Harga Dasar</th>
                                        <th className='border border-slate-600'>Stock</th>
                                        <th className='border border-slate-600'>Image</th>
                                        <th className='border border-slate-600'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        products ? products.map((item, index) => (
                                            <tr key={index}>
                                                <td className='p-2 border border-slate-700'>{ index + 1 }</td>
                                                <td className='p-2 border border-slate-700'>{ item.name }</td>
                                                <td className='p-2 border border-slate-700'>{ item.product_code }</td>
                                                <td className='p-2 border border-slate-700'>{ item.category }</td>
                                                <td className='p-2 border border-slate-700'>{ item.selling_price }</td>
                                                <td className='p-2 border border-slate-700'>{ item.purchase_price }</td>
                                                <td className='p-2 border border-slate-700'>{ item.total_stock }</td>
                                                <td className='p-2 border border-slate-700'>
                                                    <div className='flex justify-center'>
                                                        <img src={ item.image } className='w-[80px]'  alt="" />
                                                    </div>
                                                </td>
                                                <td className='border border-slate-600'>
                                                    <div className='p-2 flex justify-center gap-2'>
                                                        <button type="button" className='px-2 py-2 rounded-md bg-red-800 text-white' onClick={() => deleteProduct(item.id)}>delete</button>
                                                        <Link href={route('product.edit', item.id)} className='px-2 py-2 rounded-md bg-green-800 text-white'>
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

            <AddProduct show={show} onClose={toggleAddProduct} categories={categories} />
        </AuthenticatedLayout>
    );
}
