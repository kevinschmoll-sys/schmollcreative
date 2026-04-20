#!/usr/bin/env python3
import http.server, os

class Handler(http.server.SimpleHTTPRequestHandler):
    def end_headers(self):
        self.send_header('ngrok-skip-browser-warning', 'true')
        self.send_header('Access-Control-Allow-Origin', '*')
        super().end_headers()
    def log_message(self, format, *args):
        pass

os.chdir('/Users/kevinschmoll/Desktop/schmollcreative/static-build')
httpd = http.server.HTTPServer(('', 8080), Handler)
print('Serving on http://localhost:8080')
httpd.serve_forever()
