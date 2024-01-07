// config-overrides.js
module.exports = function override(config, env) {
    // Modify the output filenames
    config.output.filename = 'static/js/[name].js';
    config.output.chunkFilename = 'static/js/[name].chunk.js';
  
    return config;
  };
  