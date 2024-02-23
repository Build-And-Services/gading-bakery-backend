import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useState } from 'react';
import AddProduct from './Partials/AddProduct';

export default function Products({ products, categories, auth, errors }) {
    const [show, setShow] = useState(false);

    const toggleAddProduct = () => {
        setShow(prevState => !prevState);
    }

    return (
        <AuthenticatedLayout
            auth={auth}
            errors={errors}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Product</h2>}
        >
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
                                        <th className='border border-slate-600'>Kategory</th>
                                        <th className='border border-slate-600'>Harga Jual</th>
                                        <th className='border border-slate-600'>Harga Dasar</th>
                                        <th className='border border-slate-600'>Stock</th>
                                        <th className='border border-slate-600'>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {
                                        products ? products.map((item, index) => (
                                            <tr key={index}>
                                                <td className='p-2 border border-slate-700'>{ index + 1 }</td>
                                                <td className='p-2 border border-slate-700'>{ item.name }</td>
                                                <td className='p-2 border border-slate-700'>{ item.category }</td>
                                                <td className='p-2 border border-slate-700'>{ item.selling_price }</td>
                                                <td className='p-2 border border-slate-700'>{ item.purchase_price }</td>
                                                <td className='p-2 border border-slate-700'>{ item.total_stock }</td>
                                                <td className='p-2 border border-slate-700 flex gap-1 justify-center'>
                                                    <button className='px-2 py-1 rounded-md bg-red-800 text-white'>
                                                        delete
                                                    </button>
                                                    <button className='px-2 py-1 rounded-md bg-green-800 text-white'>
                                                        edit
                                                    </button>
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
