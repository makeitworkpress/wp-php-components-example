const esbuild = require("esbuild");
const { sassPlugin } = require("esbuild-sass-plugin");
const postcss = require('postcss');
const autoprefixer = require('autoprefixer');

esbuild.build({
  entryPoints: ["src/assets/css/styles.scss", "src/assets/js/scripts.ts"],
  outdir: "public",
  bundle: true,
  metafile: true,
  plugins: [
      sassPlugin({
          async transform(source) {
              const { css } = await postcss([autoprefixer]).process(source);
              return css;
          },
      }),
  ],
  watch: true
})
.then(() => console.log("⚡ Complete! ⚡"))
.catch( () => process.exit(1));