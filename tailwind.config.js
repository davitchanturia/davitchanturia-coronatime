module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      spacing: {
        99: '24.75rem',
        336: '84.375rem',
      },
      colors: {
        headText: '#010414',
        newCases: '#edeefe',
        newCasesNum: '#2029F3',
        recovered: '#ecf9f3',
        recoveredNum: '#0FBA68',
        death: '#fdfced',
        deathNum: '#EAD621',
        darkBlack: '#010414',
        grey: '#808189',
        forgotPas: '#2029F3',
        greenButton: '#0FBA68',
      }
    },
  },
  plugins: [],
}
