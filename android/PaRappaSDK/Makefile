VERSION = 0.0.01

.PHONY: dist clean
dist:
	mkdir -p dist/parappa-${VERSION}
	cd bin && jar cf ../dist/parappa-${VERSION}/parappa.jar me
	cp README.txt dist/parappa-${VERSION}/
	cd dist && zip -r parappa-${VERSION}.zip parappa-${VERSION}

clean:
	rm -rf dist
