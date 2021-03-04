# library
from click.decorators import command
from pyngrok import ngrok
import requests
import json
import click
from click import echo, style
from pyfiglet import Figlet, main
import colorama
import os.path
import subprocess
import shutil
import os
# start
banner = Figlet(font="slant")
banner_txt = banner.renderText("RaRa")
echo(style(banner_txt, fg='blue'))
dirBot = os.path.dirname(os.path.abspath(__file__))+"\\Bot"
# defs


def editfile(file, content):
    path = dirBot+'//'+file
    with open(path, "w") as f:
        f.write(content)


def Botedit(port, token):
    editfile('public.bat', f'rara public {port} token.txt')
    editfile('local.bat', f'rara php {port} src')
    editfile('All.bat', f'start cmd /c rara php {port} src \n rara public {port} token.txt')
    editfile('token.txt', token)


def creatproject(name, port, token):
    Botedit(port, token)
    copyDirectory(dirBot, name)


def token_read(path):
    f = open(path, 'r')
    return f.read()


@click.group(chain=True)
@click.version_option("0.1.0")
def cli():
    pass


@cli.command('public',)
@click.argument('port')
@click.argument('token', required=False)
def public(port, token=""):
    """
      public url <port>(required) <token> (telegram bot - file/text)
    """
    if port:
        tun = ngrok.connect(port, bind_tls=True)
        url = tun.public_url
        if token:
            if os.path.isfile(token):
                bot = token_read(token)
            else:
                bot = token
            send = "https://api.telegram.org/bot"+bot+"/setWebhook?url="+url
            api = requests.get(send)
            text = api.text
            result = json.loads(text)
            if result['ok'] == True:
                echo(style("\nWebhook is set", bold=True, fg='green'))
            else:
                echo(style("\nWebhook isn't set", bold=True, fg='red'))
                echo(
                    style("\nERROR : "+result['description'], bold=True, fg='red'))
                exit()
        echo(
            style(f"\nLocal Server Listen http://localhost:{port}", bold=True, fg='green'))
        echo(style('\nPublic Server listen : '+url, bold=True, fg='green'))

        ngrok_process = ngrok.get_ngrok_process()
        try:
            ngrok_process.proc.wait()
        except KeyboardInterrupt:
            echo(style("\n\nServer is off", bold=True, fg='red'),)
            ngrok.kill()


@cli.command('php')
@click.argument('port')
@click.argument('path', required=False, default='/')
def php(port, path):
    """
    start php <port>(required) <path>
    """
    subprocess.call(f"php -S localhost:{port} -t {path}")


def copyDirectory(src, dest):
    try:
        shutil.copytree(src, dest)
    except shutil.Error as e:
        print('Directory not copied. Error: %s' % e)
    except OSError as e:
        print('Directory not copied. Error: %s' % e)


@cli.command('create')
@click.argument('name')
def create(name):
    """
        Create New Telegram bot project php
    """
    port = int(click.prompt(style('Project Port ',fg='green')))
    token = click.prompt(style('\nTelegram Bot Token ',fg='green'))
    creatproject(name, port, token)
def main():
    cli()


# run
if __name__ == "__main__":
    main()
