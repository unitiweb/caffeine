module.exports = {
    future: {
        // removeDeprecatedGapUtilities: true,
        // purgeLayersByDefault: true,
    },
    purge: false,
    darkMode: false,
    theme: {
        extend: {}
    },
    variants: {},
    plugins: [
        require('@tailwindcss/forms')
    ],
}
