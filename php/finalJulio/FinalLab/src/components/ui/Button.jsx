function Button({ children, type = "button", ...props }) {
  return (
    <button
      type={type}
      className="w-full text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5"
      {...props}
    >
      {children}
    </button>
  );
}

export default Button;
