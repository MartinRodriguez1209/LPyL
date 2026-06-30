function Input({ type = "text", ...props }) {
  return (
    <input
      type={type}
      className="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
      {...props}
    />
  );
}

export default Input;
