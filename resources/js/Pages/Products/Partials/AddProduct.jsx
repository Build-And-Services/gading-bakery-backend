import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import Modal from "@/Components/Modal";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from '@inertiajs/react';

export default function AddProduct({ show, onClose, categories }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        category: '',
        purchase_price: '',
        selling_price: '',
        quantity: '',
        image: 'https://www.google.com',
    });

    const submit = (e) => {
        e.preventDefault();
    }

    return (
        <>
            <Modal show={show} onClose={onClose}>
                <div className="p-5">
                    <h1 className="mb-2">Tambah Product</h1>
                    <form action={submit}>
                        <div className="mb-5">
                            <InputLabel htmlFor="name" value="Name" />
                            <TextInput
                                id="name"
                                className="mt-1 block w-full"
                                required
                                isFocused
                                autoComplete="name"
                            />
                            <InputError className="mt-2" />
                        </div>
                        <div className="mb-5">
                            <InputLabel htmlFor="Kategori" value="Kategori" />
                            <select name="category_id" id="kategori" className="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                {
                                    categories.map((item, index) => <option key={index} value={item.id}>{item.name}</option>)
                                }
                            </select>
                            <InputError className="mt-2" />
                        </div>

                        <div className="flex gap-3 mb-5">
                            <div className="flex-1">
                                <InputLabel htmlFor="name" value="Harga Jual" />
                                <TextInput
                                    className="mt-1 block w-full"
                                    required
                                    autoComplete="selling_price"
                                />
                                <InputError className="mt-2" />
                            </div>
                            <div className="flex-1">
                                <InputLabel htmlFor="name" value="Harga Dasar" />
                                <TextInput
                                    className="mt-1 block w-full"
                                    required
                                    autoComplete="purchase_price"
                                />
                                <InputError className="mt-2" />
                            </div>
                        </div>

                        <div className="mb-5 flex gap-2">
                            <button className="rounded-md bg-green-700 text-white px-5 py-2" type="submit">Save</button>
                            <button className="rounded-md bg-red-700 text-white px-5 py-2" onClick={onClose}>Cancel</button>
                        </div>
                    </form>
                </div>
            </Modal>
        </>
    )
}