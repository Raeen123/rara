from setuptools import setup
setup(
    name = 'rara',
    version = '0.1.0',
    packages = ['rara'],
    entry_points = {
        'console_scripts': [
            'rara = rara.__main__:main'
        ]
    })