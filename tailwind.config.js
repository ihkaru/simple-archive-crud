module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.ts',
		'./resources/**/*.vue',
	],
	theme: {
		extend: {},
	},
    presets: [require("./vendor/filament/filament/tailwind.config.js")],
}
