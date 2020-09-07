const helperFunction = {}
helperFunction.otp_generator = function() {
    const ran = () =>
      [1, 2, 3, 4, 5, 6, 7, 8, 9, 0].sort((x, z) => {
        ren = Math.random();
        if (ren == 0.5) return 0;
        return ren > 0.5 ? 1 : -1;
      });
    return Array(6)
      .fill(null)
      .map(x => ran()[(Math.random() * 9).toFixed()])
      .join("");
  }
  module.exports = helperFunction;
