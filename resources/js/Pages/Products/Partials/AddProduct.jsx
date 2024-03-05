import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import Modal from "@/Components/Modal";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";

export default function AddProduct({ show, onClose, categories }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        category_id: "",
        purchase_price: "",
        selling_price: "",
        product_code: "",
        quantity: "",
        // image: 'https://www.google.com',
        image: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        // console.log("Selected option:", data.category_id);
        // console.log('submit');
        post(route("product.store"));
    };

    return (
        <>
            <Modal show={show} onClose={onClose}>
                <div className="p-5">
                    <h1 className="mb-2">Tambah Product</h1>
                    <form onSubmit={handleSubmit}>
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
                                htmlFor="Product Code"
                                value="Product Code"
                            />
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
                            <InputLabel htmlFor="Kategori" value="Kategori" />
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
                                    htmlFor="selling_price"
                                    value="Harga Jual"
                                />
                                <TextInput
                                    value={data.selling_price}
                                    onChange={(e) =>
                                        setData({
                                            ...data,
                                            selling_price: e.target.value,
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
                                    htmlFor="purchase_price"
                                    value="Harga Dasar"
                                />
                                <TextInput
                                    value={data.purchase_price}
                                    onChange={(e) =>
                                        setData({
                                            ...data,
                                            purchase_price: e.target.value,
                                        })
                                    }
                                    className="mt-1 block w-full"
                                    required
                                    autoComplete="purchase_price"
                                />
                                <InputError className="mt-2" />
                            </div>
                            <div className="flex-1">
                                <InputLabel
                                    htmlFor="quantity"
                                    value="Quantity"
                                />
                                <TextInput
                                    value={data.quantity}
                                    onChange={(e) =>
                                        setData({
                                            ...data,
                                            quantity: e.target.value,
                                        })
                                    }
                                    className="mt-1 block w-full"
                                    required
                                    autoComplete="quantity"
                                />
                                <InputError className="mt-2" />
                            </div>
                        </div>
                        <div className="flex-1 my-5">
                            <InputLabel htmlFor="image" value="Image" />
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
                            <button
                                className="rounded-md bg-red-700 text-white px-5 py-2"
                                type="button"
                                onClick={onClose}
                            >
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </Modal>
        </>
    );
}
