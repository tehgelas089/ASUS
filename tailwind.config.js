/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class', // ✅ tambahkan ini agar bisa pakai mode gelap & terang
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
