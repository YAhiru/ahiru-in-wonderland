const path = require('path');

module.exports = {
  paths: function (paths, env) {
    paths.appSrc = path.resolve(__dirname, 'resources/js');
    paths.appIndexJs = path.resolve(__dirname, 'resources/js/index.tsx');
    paths.testsSetup = path.resolve(__dirname, 'resources/js/setupTests');
    paths.proxySetup = path.resolve(__dirname, 'resources/js/setupProxy.js');
    paths.appTypeDeclarations = path.resolve(__dirname, 'resources/js/react-app-env.d.ts');
    paths.appBuild = path.resolve(__dirname, 'build/public');

    return paths;
  },
};
