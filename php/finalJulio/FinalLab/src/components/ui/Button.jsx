function Button({ children, type = "button", className = "", ...props }) {
  return (
    <button
      type={type}
      className={`text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 ${className}`}
      {...props}
    >
      {children}
    </button>
  );
}

export default Button;
