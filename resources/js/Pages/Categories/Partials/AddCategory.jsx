import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import Modal from "@/Components/Modal";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";

export default function AddCategory({ show, onClose, categories }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        // image: 'https://www.google.com',
        image: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        // console.log("Selected option:", data.category_id);
        // console.log('submit');
        post(route("category.store"));
    };

    return (
        <>
            <Modal show={show} onClose={onClose}>
                <div className="p-5">
                    <h1 className="mb-2">Tambah Category</h1>
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
