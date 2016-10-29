# Welcome to the Flat File Markdown Server
This website works dynamically per directory structure of `markdown/`. Any directory that you create in `markdown/` will create a submenu and any markdown (`.md`) files will be served as pages and be listed in their appropriate subfolders.

## Traditional Markdown
Your usual markdown language is rendered normally. All markdown is rendered using [Marked.js](https://github.com/chjj/marked) and [Strapdown.js](http://strapdownjs.com).

```python
class node:
    def __init__(self, data = None, next = None):
        self.data = data # this contain the node data
        self.next = None # this is the referende to the next node
    def __str__(self):
        return '[' + str(self.data) + ']'
```

### Lastly
You can modify some customization settings in `/opt/md2html_jn/cache/config.ini`  
The `theme_mode` options are `default` (light) or `inverse` (dark) -- *your usual Bootstrap `navbar` themes*.
