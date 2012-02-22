# Kohana 3.3 FirePHP module
## Profiling and Debugging your Kohana through Firebug

### Installation:
1. Download this module and add it to your MODPATH
2. Update submodules inside of this modules folder
3. Enable it in the bootstrap

### Notes:
- You must install [Firebug](https://addons.mozilla.org/en-US/firefox/addon/firebug/) and [FirePHP](https://addons.mozilla.org/en-us/firefox/addon/firephp/) to use this module
- FirePHP sends its' data through headers, meaning:
	- Your server probably limits header size to ~8KB
	- Outputting large datasets can break this
- Although there's a catch for PRODUCTION mode inside of the init file,
  it's *highly* recommended that you disable this module in production