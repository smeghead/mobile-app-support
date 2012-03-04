VERSION = $(shell grep 'PARAPPA_VERSION = ' src/me/parappa/sdk/PaRappa.java | sed -e 's/.*"\([0-9]\+\.[0-9]\+\.[0-9]\+\)".*/\1/')

.PHONY: dist clean
dist:
	mkdir -p dist/parappa-${VERSION}
	cd bin && zip -r ../dist/parappa-${VERSION}/parappa.jar me
	cp README.txt dist/parappa-${VERSION}/
	cd dist && zip -r parappa-${VERSION}.zip parappa-${VERSION}

clean:
	rm -rf dist
